<?php

namespace common\models\report;

use Yii;
use common\models\client\Client;

/**
 * This is the model class for table "ledger_report".
 *
 * @property string|null $due_date Date when this payment is due
 * @property string|null $member_account
 * @property string|null $description
 * @property float|null $amount
 */
class LedgerReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ledger_report';
    }
    
      public static function primaryKey() {
        return ['id'];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['due_date'], 'safe'],
            [['amount'], 'number'],
            [['member_account'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'due_date' => 'Due Date',
            'member_account' => 'Member Account',
            'description' => 'Description',
            'amount' => 'Amount',
        ];
    }
    
        /**
     * Associated Loan 
     */
    public function getClient() {
        return $this->hasOne(Client::class, ['id' => 'id']);
    }
}
