<?php

namespace common\models\client;

use Yii;
use common\models\client\MasterData;
use common\models\masterdata\Company;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\client\ClientDocuments;
use common\models\loan\Ledger;
use common\models\client\LoanManagerRemarks;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $account_number
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
            [['firstname', 'lastname', 'telephone', 'date_of_birth', 'person_scenario', 'status', 'created_at', 'nin','created_by'], 'required'],
            [['identification_type', 'office_id', 'client_classification_status', 'is_staff_memeber', 'client_type', 'address_type', 'gender', 'marital_status', 'status', 'related_to', 'created_at', 'next_kin_status', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['date_of_birth'], 'safe'],
            [['account_number', 'passport_photo', 'external_id', 'firstname', 'lastname', 'othername', 'email', 'person_scenario', 'relationship'], 'string', 'max' => 100],
            [['identification_number', 'nin', 'telephone', 'alt_telephone'], 'string', 'max' => 14],
            [['address'], 'string', 'max' => 500],
            ['email', 'email'],
            [['identification_number'], 'unique'],
            [['telephone'], 'unique'],
            [['telephone'], 'match', 'pattern' => '/^(\D*)?(\d{3})(\D*)?(\d{3})(\D*)?(\d{4})$/', 'message' => 'Invalid Telephone number format'],
            [['external_id','nin','firstname','lastname','othername'], 'match', 'pattern' => "/^[A-Za-z0-9_]+$/u", 'message' => 'File Number does not contain special characters '],
            [['firstname','lastname','othername'], 'match', 'pattern' => "/^[a-zA-Z\s]+$/", 'message' => 'Contains only letters'],
            [['nin'], 'string', 'min' => 14, 'message' => 'You must enter minimum 20 characters'],
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
            'office_id' => 'Office Name',
            'client_type' => 'Client Type',
            'nin' => 'NIN',
            'external_id' => 'File Number',
            'is_staff_memeber' => 'Is Staff a Member?',
            'address_type' => 'Address Type',
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
            'account_number' => 'System ID'
        ];
    }

    
    
    public function getGenderType() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'gender']);
    }

    public function getIdentificationType() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'identification_type']);
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

    public function getRelationshipType() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'relationship']);
    }

    public function getMembershipType() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'membership_type']);
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
    public function getAge() {
        $tz = new \DateTimeZone('Africa/Kampala');
        if (defined($this->date_of_birth)) {
            return \DateTime::createFromFormat('d-m-Y', $this->date_of_birth, $tz)
                            ->diff(new \DateTime('now', $tz))
                    ->y;
        } else {
            return '-';
        }
    }

    /**
     * Generate Request Reference  Number
     */
    public function generateReferenceNumber() {
        $pref = self::getClientCode()['code'];
        //$prefix = strtoupper(substr($pref, 0, 3));
        return $pref . time();
    }

    public function getPassportPhoto() {
        if (!empty($this->passport_photo)) {
            return Yii::getAlias('@web/html') . "/passport/" . $this->passport_photo;
        } else {
            return Yii::getAlias('@web/html') . "/passport/default.jpeg";
        }
    }

    /**
     * Registration Documents presented by this client
     * @return CompanyDocument
     */
    public function getSupportingDocuments() {
        return $this->hasMany(ClientDocuments::className(), ['client_id' => 'id']);
    }

    /**
     * Approved Remarks on this client
     * @return CompanyDocument
     */
    public function getApprovalRemarks($cat = "CLIENT", $status = 1) {
        $searchModel = new LoanManagerRemarksSearch();
        $searchModel->client_id = $this->id;
        $searchModel->category = "CLIENT";
        $searchModel->remarks_status = $status;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }

    /**
     * Rejection Remarks on this client
     * @return CompanyDocument
     */
    public function getRejectionRemarks($cat = "CLIENT", $status = 2) {
        $searchModel = new LoanManagerRemarksSearch();
        $searchModel->client_id = $this->id;
        $searchModel->category = $cat;
        $searchModel->remarks_status = $status;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }

    /**
     * Show Identification Type 
     */
    public function getIdentification() {
        return $this->identificationType->name;
    }

    /**
     * 
     * Show Client Types
     */
    public function getClientTypes() {
        return $this->clientType->name;
    }

    /**
     * 
     * Show Client Classification Status
     */
    public function getClientClassificationStatus() {
        return $this->classificationStatus->name;
    }

    /**
     * 
     * Show Client Classification Status
     */
    public function getProfile() {
        $url = $this->passportPhoto;
        return Html::img($url, ['alt' => 'avatar', 'width' => '50', 'height' => '50']);
    }

    /**
     * Show Status Button 
     */
    public function getStatusButton() {
        return "<badge class='badge badge-{$this->memberStatus->css_class}'>" . $this->memberStatus->name . '</badge>';
    }

    /**
     * Get Client Link
     */
    public function getAccountNumber() {
        return '<b><a href="' . Url::to(['client/view', 'id' => $this->id]) . '">' . $this->account_number . "</a></b>";
    }

       
     public function getLoanEntries() {
         return $this->hasMany(Loan::class, ['client_id' => 'id']);
         

    }
    
    
    public function getClientRemarks() {
        return $this->hasMany(LoanManagerRemarks::class, ['client_id' => 'id']);
    }
    


}
