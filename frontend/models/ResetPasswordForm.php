<?php
namespace frontend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    
    public $password;
    public $password_status;
    public $password_compare;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password_compare', 'required'],
            ['password_status', 'required'],
            [['password'], 'match', 'pattern' => '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', 'message' => 'Password should contain at least 8 characters, atleast a capital letter, a number & special character.'],
            ['password_compare', 'string', 'min' => 8,'max'=>100],
            ['password_compare', 'compare', 'compareAttribute'=>'password','message' => 'Your passwords don\'t match']
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->password_status=1;
        $user->removePasswordResetToken();

        return $user->save(false);
    }
    
    
	//matching the old password with your existing password.
	public function findPasswords($attribute, $params)
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
		if ($user->password != md5($this->old_password)) {
            $this->addError($attribute, 'Old password is incorrect.');
        }
    }
}
