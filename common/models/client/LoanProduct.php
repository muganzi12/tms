<?php

namespace common\models\client;

use Yii;
use common\models\client\MasterData;
use common\models\client\ChartOfAccounts;

/**
 * This is the model class for table "loan_product".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $interest_rate
 * @property int $account_to_credit
 * @property int $account_to_debit
 * @property int $currency
 * @property float $processing_loan_fees
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
            [['name', 'description', 'interest_rate','product_code', 'account_to_credit', 'account_to_debit', 'processing_loan_fees', 'minimum_amount', 'maximum_amount', 'maximum_repayment_period','principal_installment_frequency','interest_frequency', 'status', 'penalty', 'created_at', 'created_by'], 'required'],
            [['interest_rate', 'processing_loan_fees', 'minimum_amount', 'maximum_amount', 'penalty'], 'number'],
            [['account_to_credit', 'account_to_debit', 'maximum_repayment_period','status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
            'interest_rate' => 'Interest Rate',
            'account_to_credit' => 'Account To Credit',
            'account_to_debit' => 'Account To Debit',
            'principal_installment_frequency' => 'Principal Installment Frequency',
            'interest_frequency' => 'Interest Frequency',
            'processing_loan_fees' => 'Processing Loan Fees',
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
        return $this->hasOne(MasterData::class, ['id' => 'status']);
    }

    // Get an account to credit
    public function getAccountToCredit() {
        return $this->hasOne(ChartOfAccounts::class, ['id' => 'account_to_credit']);
    }

   // Get an account to debit
    public function getAccountToDebit() {
        return $this->hasOne(ChartOfAccounts::class, ['id' => 'account_to_debit']);
    }

}
