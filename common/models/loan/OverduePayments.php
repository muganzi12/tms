<?php

namespace common\models\loan;

use Yii;

/**
 * This is the model class for table "overdue_payments".
 *
 * @property int $entry_reference
 * @property int $entry_reference_id
 * @property string $due_date
 * @property string $description
 * @property int|null $account
 * @property float $amount
 * @property string|null $member_Account
 * @property string $entry_type
 * @property int|null $entry_period
 * @property int $created_at
 * @property int|null $updated_at
 * @property int $ledger_status
 */
class OverduePayments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'overdue_payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entry_reference', 'entry_reference_id', 'account', 'entry_period', 'created_at', 'updated_at', 'ledger_status'], 'integer'],
            [['due_date'], 'required'],
            [['due_date'], 'safe'],
            [['amount'], 'number'],
            [['description'], 'string', 'max' => 255],
            [['member_Account'], 'string', 'max' => 45],
            [['entry_type'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'entry_reference' => 'Entry Reference',
            'entry_reference_id' => 'Entry Reference ID',
            'due_date' => 'Due Date',
            'description' => 'Description',
            'account' => 'Account',
            'amount' => 'Amount',
            'member_Account' => 'Member  Account',
            'entry_type' => 'Entry Type',
            'entry_period' => 'Entry Period',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ledger_status' => 'Ledger Status',
        ];
    }
}
