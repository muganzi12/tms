<?php

namespace common\models\client;

use Yii;
use common\models\client\ClientMasterData;

/**
 * This is the model class for table "loan_guarantor".
 *
 * @property int $id
 * @property int $loan_id
 * @property string $firstname
 * @property string $lastname
 * @property string|null $othername
 * @property int $identification_type
 * @property string $identification_number
 * @property string $telephone_primary
 * @property string $telephone_alternative
 * @property string|null $employer_name
 * @property string|null $source_of_income
 * @property string $physical_address
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class LoanGuarantor extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'loan_guarantor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['loan_id', 'firstname', 'lastname', 'identification_type', 'identification_number', 'telephone_primary', 'gender','physical_address', 'created_at', 'created_by'], 'required'],
            [['loan_id', 'gender', 'identification_type', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['firstname', 'lastname', 'othername', 'employer_name', 'source_of_income'], 'string', 'max' => 100],
            [['identification_number', 'telephone_primary', 'telephone_alternative'], 'string', 'max' => 14],
            [['telephone_primary'], 'match', 'pattern' => '/^(\D*)?(\d{3})(\D*)?(\d{3})(\D*)?(\d{4})$/', 'message' => 'Invalid Telephone number format'],
            [['identification_number','firstname','lastname','othername'], 'match', 'pattern' => "/^[A-Za-z0-9_]+$/u", 'message' => 'File Number does not contain special characters '],
            [['firstname','lastname','othername'], 'match', 'pattern' => "/^[a-zA-Z\s]+$/", 'message' => 'Contains only letters'],
            [['identification_number'], 'string', 'min' => 14, 'message' => 'You must enter minimum 14 characters'],
            [['physical_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
       public function attributeLabels() {
        return [
            'id' => 'ID',
            'loan_id' => 'Loan ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'othername' => 'Othername',
            'gender' => "Gender",
            'identification_type' => 'ID Type',
            'identification_number' => 'ID Number',
            'telephone_primary' => 'Telephone ',
            'telephone_alternative' => 'Telephone Alternative',
            'employer_name' => 'Employer Name',
            'source_of_income' => 'Source of Income',
            'physical_address' => 'Physical Address',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

     public function getIdentificationType() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'identification_type']);
    }
    
       public function getGenderType() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'gender']);
    }

}
