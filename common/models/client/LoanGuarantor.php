<?php

namespace common\models\client;

use Yii;
use common\models\client\MasterData;

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
            [['loan_id', 'firstname', 'lastname', 'identification_type', 'identification_number', 'telephone_primary', 'gender', 'telephone_alternative', 'physical_address', 'created_at', 'created_by'], 'required'],
            [['loan_id', 'gender', 'identification_type', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['firstname', 'lastname', 'othername', 'employer_name', 'source_of_income'], 'string', 'max' => 100],
            [['identification_number', 'telephone_primary', 'telephone_alternative'], 'string', 'max' => 14],
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
            'identification_type' => 'Identification Type',
            'identification_number' => 'Identification Number',
            'telephone_primary' => 'Telephone Primary',
            'telephone_alternative' => 'Telephone Alternative',
            'employer_name' => 'Employer Name',
            'source_of_income' => 'Source Of Income',
            'physical_address' => 'Physical Address',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getIdentificationType() {
        return $this->hasOne(MasterData::class, ['id' => 'identification_type']);
    }

}
