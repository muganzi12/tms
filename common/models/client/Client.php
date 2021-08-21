<?php

namespace common\models\client;

use Yii;
use common\models\client\MasterData;
use common\models\masterdata\Company;
use yii\db\Query;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 *  * @property string $reference_number
 * @property string $firstname
 * @property string $lastname
 * @property string|null $othername
 * @property int $identification_type
 * @property string $identification_number
 * @property string $telephone
 * @property string|null $alt_telephone
 * @property int $gender
 * @property int $marital_status
 * @property string $date_of_birth
 * @property string $address
 * @property string $email
 * @property string $person_scenario
 * @property string|null $relationship
 * @property int $status
 * @property int|null $related_to
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Client extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['firstname', 'lastname', 'identification_type', 'identification_number', 'telephone', 'gender', 'marital_status', 'date_of_birth', 'address', 'person_scenario', 'status', 'created_at', 'created_by'], 'required'],
            [['identification_type', 'gender', 'marital_status','status', 'related_to', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['date_of_birth'], 'safe'],
            [['reference_number', 'passport_photo','firstname', 'lastname', 'othername', 'email', 'person_scenario', 'relationship'], 'string', 'max' => 100],
            [['identification_number', 'telephone', 'alt_telephone'], 'string', 'max' => 14],
            [['address'], 'string', 'max' => 500],
            [['identification_number'], 'unique'],
            [['telephone'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'othername' => 'Othername',
            'identification_type' => 'Identification Type',
            'identification_number' => 'Identification Number',
            'telephone' => 'Telephone',
            'alt_telephone' => 'Alt Telephone',
            'gender' => 'Gender',
            'marital_status' => 'Marital Status',
            'date_of_birth' => 'Date Of Birth',
            'address' => 'Physical Address',
            'email' => 'Email',
            'person_scenario' => 'Person Scenario',
            'relationship' => 'Relationship',
            'status' => 'Status',
            'related_to' => 'Related To',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getGenderType() {
        return $this->hasOne(MasterData::class, ['id' => 'gender']);
    }

    public function getIdentificationType() {
        return $this->hasOne(MasterData::class, ['id' => 'identification_type']);
    }

    public function getMaritalStatus() {
        return $this->hasOne(MasterData::class, ['id' => 'marital_status']);
    }

    public function getMemberStatus() {
        return $this->hasOne(MasterData::class, ['id' => 'status']);
    }

    public function getRelationshipType() {
        return $this->hasOne(MasterData::class, ['id' => 'relationship']);
    }

    public function getMembershipType() {
        return $this->hasOne(MasterData::class, ['id' => 'membership_type']);
    }

    public function getClient() {
        return $this->hasOne(Client::class, ['id' => 'related_to']);
    }

    public function getNextOfKin() {
        return $this->hasMany(Client::class, ['related_to' => 'id']);
    }

    public static function getClientCode() {
        $query = new Query();
        $inst = Yii::$app->member->client_id;
        return Company::find()->select(['code'])->where(['id' => $inst])->one();
    }

        public function getFullNames() {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * The age of this client
     */
    public function getAge(){
        $tz  = new \DateTimeZone('Africa/Kampala');
        return \DateTime::createFromFormat('Y-m-d', $this->date_of_birth, $tz)
            ->diff(new \DateTime('now', $tz))
            ->y;
    }
    /**
     * Generate Request Reference  Number
     */
    public function generateReferenceNumber() {
        $pref = self::getClientCode()['code'];
        //$prefix = strtoupper(substr($pref, 0, 3));
        return $pref . time();
    }

}
