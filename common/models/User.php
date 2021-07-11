<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\models\sacco\Sacco;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
     public function rules() {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['username', 'trim'],
            [['app_module', 'sacco_id','branch_id','office_id','password_status','updated_at','updated_by'], 'integer'],
            [['profile_pic', 'signature'], 'string', 'max' => 255],
            ['institution_id', 'required', 'message' => 'Fill in your Bank'],
            ['username', 'required','message'=>'Provide User Name'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Fill in your email'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['firstname', 'required','message' => 'Fill in your First Name'],
            ['account_type', 'required'],
            ['lastname', 'required','message' => 'Fill in your Last Name'],
            ['othername','string','max' => 255],
            ['telephone', 'required','message' => 'Fill in your Telephone Number'],
            ['created_by', 'required'],
            ['branch_id', 'required','message' => 'Select Branch He/She Belongs to'],
            ['created_at', 'required'],
            ['sacco_id', 'required'],
            ['office_id', 'required'],
            ['app_module', 'required','message'=>'Select System Module'],
            [['auth_key'], 'string', 'max' => 32],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password_hash', 'required'],
            ['password_hash', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'User Name',
            'institution_id' => 'Bank/SACCO',
            'email' => 'Email',
            'firstname'=>'First Name',
            'lastname'=>'Last Name',
            'othername'=>'Other Name',
            'branch_id' => 'Branch',
            'office_id' => 'Office Held',
            'is_receiving_officer'=>'Is She/He a Receiving Officer?',
            'status' => 'Status',
            'password_hash' => 'Password'
        ];
    }
    
       public function beforeSave($insert) {
        parent::beforeSave($insert);
        if ($this->isNewRecord) {
            $this->created_at = time();
            $this->status = 10;
            $this->created_by = Yii::$app->user->id;
            //Create random password
            $passwd = Yii::$app->security->generateRandomString(11);
            //Save this password to the currrent session
            Yii::$app->session->set('default_password', $passwd);
            $this->password_hash = Yii::$app->security->generatePasswordHash($passwd);
            $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
            $this->auth_key = Yii::$app->security->generateRandomString();
        } else {
            $this->updated_at = time();
            $this->updated_by = Yii::$app->member->id;
        }
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
      public static function findByUsername($username) {
        return static::findOne([
                    'username' => $username,
                    'status' => self::STATUS_ACTIVE,
                    'app_module' => Yii::$app->app_module
        ]);
    }
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
                    'verification_token' => $token,
                    'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken() {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    /**
     * Details of the currently logged in User
     * @return \common\models\User
     */
    public static function findLoggedInUser() {
        return self::findOne(Yii::$app->user->id);
    }

    public function getSacco() {
        return $this->hasOne(Sacco::class, ['id' => 'sacco_id']);
    }
    


  public function getFullnames() {
        return $this->firstname . ' ' . $this->lastname;
    }
    
     public function getProfilePicture() {
        if (!empty($this->profile_pic)) {
            return Yii::getAlias('@web/html') . "/profile-pics/" . $this->profile_pic;
        } else {
            return Yii::getAlias('@web/html') . "/profile-pics/default.jpeg";
        }
    }
    
      public function getSignature() {
        if (!empty($this->signature)) {
            return Yii::getAlias('@web/html') . "/signature" . $this->signature;
        } 
    }

    

}
