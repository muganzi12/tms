<?php

namespace common\models\client;

use Yii;

/**
 * This is the model class for table "investment".
 *
 * @property int $id
 * @property int $investor_id
 * @property int $loan_product
 * @property int $account_to_credit
 * @property int $account_to_debit
 * @property float $amount_to_invest
 * @property float $investment_duration
 * @property float $interest_rate
 * @property float $total_interest
 * @property float $expected_total_amount
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Investment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'investment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['investor_id', 'loan_product', 'account_to_credit', 'account_to_debit', 'amount_to_invest', 'investment_duration', 'interest_rate', 'total_interest', 'expected_total_amount', 'created_at', 'created_by'], 'required'],
            [['investor_id', 'loan_product', 'account_to_credit', 'account_to_debit', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['amount_to_invest', 'investment_duration', 'interest_rate', 'total_interest', 'expected_total_amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'investor_id' => 'Investor ID',
            'loan_product' => 'Loan Product',
            'account_to_credit' => 'Account To Credit',
            'account_to_debit' => 'Account To Debit',
            'amount_to_invest' => 'Amount To Invest',
            'investment_duration' => 'Investment Duration',
            'interest_rate' => 'Interest Rate',
            'total_interest' => 'Total Interest',
            'expected_total_amount' => 'Expected Total Amount',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
