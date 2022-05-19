<?php

namespace common\models\client;

use Yii;
use common\models\client\ClientMasterData;
use common\models\client\ChartOfAccounts;
use common\models\loan\LedgerTransactionConfig;
use common\models\User;
/**
 * This is the model class for table "loan_product".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $interest_rate
 * @property int $currency
 * @property float $minimum_amount
 * @property float $maximum_amount
 * @property int $maximum_repayment_period
 * @property int $number_of_installments
 * @property int $status
 * @property float $penalty
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class LoanProduct extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'loan_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'description', 'interest_rate','product_code', 'minimum_amount', 'maximum_amount', 'maximum_repayment_period','principal_installment_frequency','interest_frequency', 'status', 'penalty', 'created_at', 'created_by'], 'required'],
            [['interest_rate', 'processing_loan_fees', 'minimum_amount', 'maximum_amount', 'penalty'], 'number'],
            [['maximum_repayment_period','status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name','principal_installment_frequency','interest_frequency',], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 500],
             [['product_code'], 'string', 'max' => 45],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'product_code' => 'Product Code',
            'description' => 'Description',
            'interest_rate' => 'Interest Rate(%)',
            'principal_installment_frequency' => 'Principal Installment Frequency',
            'interest_frequency' => 'Interest Frequency',
            'minimum_amount' => 'Minimum Amount',
            'maximum_amount' => 'Maximum Amount',
            'maximum_repayment_period' => 'Maximum Repayment Period',
            'status' => 'Status',
            'penalty' => 'Late Payment Penalty',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getProductStatus() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'status']);
    }

    /**
     * Preconfigured Ledger transactions
     */
    public function getLedgerTransactions(){
        return $this->hasMany(LedgerTransactionConfig::class,['product_id'=>'id']);
    }

    /**
     * Required Documents at the point of appplying
     */
    public function getRequiredDocuments(){
        return $this->hasMany(LoanProductRequiredDocuments::class,['loan_product_id'=>'id']);
    }
    
    /**
     * The system user who created a loan product
     */
    public function getCreatedBy(){
        return $this->hasOne(User::class,['id'=>'created_by']);
    }

}
