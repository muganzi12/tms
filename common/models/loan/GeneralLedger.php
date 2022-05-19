<?php

namespace common\models\loan;

use Yii;

/**
 * This is the model class for table "general_ledger".
 *
 * @property int $entry_reference
 * @property string $due_date
 * @property string $description
 * @property int|null $account
 * @property float $amount
 * @property string|null $member_Account
 * @property string $entry_type
 * @property int|null $entry_period
 * @property int $created_at
 * @property int|null $updated_at
 * @property int|null $ledger_status
 */
class GeneralLedger extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'general_ledger';
    }

    public function primaryKey() {
        return 'id';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['entry_reference', 'account', 'entry_period', 'created_at', 'updated_at', 'ledger_status'], 'integer'],
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
    public function attributeLabels() {
        return [
            'entry_reference' => 'Entry Reference',
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
