<?php

namespace common\models\client;

use Yii;
use common\models\client\ClientMasterData;
use yii\helpers\Html;
use yii\helpers\Url;
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
              [['firstname', 'lastname', 'identification_type','nin','investor_type','reference_number', 'identfication_number','gender', 'telephone', 'physical_address', 'date_of_birth', 'created_at', 'created_by'], 'required'],
            [['identification_type', 'status', 'gender','created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['date_of_birth'], 'safe'],
            [['firstname', 'lastname', 'othername', 'email'], 'string', 'max' => 100],
            [['identfication_number', 'telephone','nin', 'alt_telephone'], 'string', 'max' => 14],
            [['physical_address', 'profile_pic','reference_number'], 'string', 'max' => 255],
            [['identfication_number'], 'unique'],
            [['telephone'], 'match', 'pattern' => '/^(\D*)?(\d{3})(\D*)?(\d{3})(\D*)?(\d{4})$/', 'message' => 'Invalid Telephone number format'],
            [['identfication_number','firstname','lastname','othername'], 'match', 'pattern' => "/^[A-Za-z0-9_]+$/u", 'message' => 'File Number does not contain special characters '],
            [['firstname','lastname','othername'], 'match', 'pattern' => "/^[a-zA-Z\s]+$/", 'message' => 'Contains only letters'],
            [['identfication_number'], 'string', 'min' => 14, 'message' => 'You must enter minimum 20 characters'],
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
            'nin'=>'NIN',
            'investor_type'=>'Investor Type',
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
     * 
     * Show Client Classification Status
     */
    public function getProfile() {
        $url = $this->passportPhoto;
        return Html::img($url, ['alt' => 'avatar', 'width' => '50', 'height' => '50']);
    }
    
       public function getFullNames() {
        return $this->firstname . ' ' . $this->lastname;
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
    
       /**
     * Get Client Link
     */
    public function getAccountNumber() {
        return '<b><a href="' . Url::to(['investor/view', 'id' => $this->id]) . '">' . $this->reference_number . "</a></b>";
    }

    
   public function getGenderType() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'gender']);
    }
    
       /**
     * 
     * Show Client Classification Status
     */
    public function getClientGender() {
        return $this->genderType->name;
    }

    public function getIdentificationType() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'identification_type']);
    }
    
        /**
     * Show Identification Type 
     */
    public function getIdentification() {
        return $this->identificationType->name;
    }

    public function getClientType() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'client_type']);
    }

    public function getClassificationStatus() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'client_classification_status']);
    }

    public function getMaritalStatus() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'marital_status']);
    }
        public function getMemberStatus() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'status']);
    }
    
      /**
     * Show Status Button 
     */
    public function getStatusButton() {
        return "<badge class='badge badge-{$this->memberStatus->css_class}'>" . $this->memberStatus->name . '</badge>';
    }

}
