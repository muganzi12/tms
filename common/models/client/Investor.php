<?php

namespace common\models\client;

use Yii;
use common\models\client\MasterData;
/**
 * This is the model class for table "investor".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string|null $othername
 * @property int $identification_type
 * @property string $identfication_number
 * @property string $telephone
 * @property string $physical_address
 * @property string|null $alt_telephone
 * @property string|null $email
 * @property string $date_of_birth
 * @property int $status
 * @property string|null $profile_pic
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Investor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'investor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'identification_type', 'identfication_number', 'telephone', 'physical_address', 'date_of_birth', 'created_at', 'created_by'], 'required'],
            [['identification_type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['date_of_birth'], 'safe'],
            [['firstname', 'lastname', 'othername', 'email'], 'string', 'max' => 100],
            [['identfication_number', 'telephone', 'alt_telephone'], 'string', 'max' => 14],
            [['physical_address', 'profile_pic'], 'string', 'max' => 255],
            [['identfication_number'], 'unique'],
            [['telephone'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'othername' => 'Other Name',
            'identification_type' => 'Identification Type',
            'identfication_number' => 'Identfication Number',
            'telephone' => 'Telephone',
            'physical_address' => 'Physical Address',
            'alt_telephone' => 'Alt Telephone',
            'email' => 'Email',
            'date_of_birth' => 'Date Of Birth',
            'status' => 'Status',
            'profile_pic' => 'Profile Pic',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
      public function getPassportPhoto() {
        if (!empty($this->profile_pic)) {
            return Yii::getAlias('@web/html') . "/passport/" . $this->profile_pic;
        } else {
            return Yii::getAlias('@web/html') . "/passport/default.jpeg";
        }
    }
    
        /**
     * The age of this Investor
     */
    public function getAge(){
        $tz  = new \DateTimeZone('Africa/Kampala');
        return \DateTime::createFromFormat('Y-m-d', $this->date_of_birth, $tz)
            ->diff(new \DateTime('now', $tz))
            ->y;
    }
    
        public function getIdentificationType() {
        return $this->hasOne(MasterData::class, ['id' => 'identification_type']);
    }
}
