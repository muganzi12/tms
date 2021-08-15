<?php

namespace common\models\client;

use Yii;

/**
 * This is the model class for table "loan_payment_schedule".
 *
 * @property int $id
 * @property int $loan_id
 * @property string $due_date
 * @property float $amount_p amount_principle rinci
 * @property float $amount_interest
 * @property float $amount_balance
 * @property int $payment_status
 * @property string|null $payment_date
 * @property float|null $penalty
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class LoanPaymentSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loan_payment_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loan_id', 'due_date', 'amount_p amount_principle rinci', 'amount_interest', 'amount_balance', 'payment_status', 'created_at', 'created_by'], 'required'],
            [['loan_id', 'payment_status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['due_date', 'payment_date'], 'safe'],
            [['amount_p amount_principle rinci', 'amount_interest', 'amount_balance', 'penalty'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loan_id' => 'Loan ID',
            'due_date' => 'Due Date',
            'amount_p amount_principle rinci' => 'Amount P Amount Principle Rinci',
            'amount_interest' => 'Amount Interest',
            'amount_balance' => 'Amount Balance',
            'payment_status' => 'Payment Status',
            'payment_date' => 'Payment Date',
            'penalty' => 'Penalty',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
