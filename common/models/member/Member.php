<?php

namespace common\models\member;

use Yii;
use common\models\sacco\Sacco;
use yii\db\Query;
/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $member_id_number
 * @property string $firstname
 * @property string $lastname
 * @property string|null $othername
 * @property string $gender
 * @property string $marital_status
 * @property string $date_of_birth
 * @property string|null $email
 * @property string $primary_telephone
 * @property string|null $secondary_telephone
 * @property int $sacco_id
 * @property string $address
 * @property string|null $member_pic
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_id_number', 'firstname', 'lastname', 'gender', 'marital_status', 'date_of_birth', 'primary_telephone', 'sacco_id', 'address', 'status', 'created_at', 'created_by'], 'required'],
            [['date_of_birth'], 'safe'],
            [['sacco_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['member_id_number', 'address', 'member_pic'], 'string', 'max' => 255],
            [['firstname', 'lastname', 'othername', 'email'], 'string', 'max' => 100],
            [['gender', 'marital_status'], 'string', 'max' => 45],
            [['primary_telephone', 'secondary_telephone'], 'string', 'max' => 13],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id_number' => 'Member Id Number',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'othername' => 'Other Name',
            'gender' => 'Gender',
            'marital_status' => 'Marital Status',
            'date_of_birth' => 'Date Of Birth',
            'email' => 'Email',
            'primary_telephone' => 'Primary Telephone',
            'secondary_telephone' => 'Secondary Telephone',
            'sacco_id' => 'Sacco ID',
            'address' => 'Address',
            'member_pic' => 'Member Pic',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
       public static function getInstitution() {
        $query = new Query();
        $inst = Yii::$app->member->sacco_id;
        return Sacco::find()->select(['name'])->where(['id' => $inst])->one();
    }
    /**
     * Generate Client Reference  Number
     */
    public function generateReferenceNumber() {
        $pref = self::getInstitution()['name'];
        $prefix =strtoupper(substr($pref, 0, 3));
        return $prefix.time();
    }

}
