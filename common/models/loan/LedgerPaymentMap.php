<?php

namespace common\models\loan;

use Yii;

/**
 * This is the model class for table "ledger_payment_map".
 *
 * @property int $ledger_id
 * @property int $payment_id
 * @property float $amount Amount paid for this ledger record. Might be useful incase of under/over payments. This amount can be used to calculate balance
 */
class LedgerPaymentMap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ledger_payment_map';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ledger_id', 'payment_id', 'amount'], 'required'],
            [['ledger_id', 'payment_id'], 'integer'],
            [['amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ledger_id' => 'Ledger ID',
            'payment_id' => 'Payment ID',
            'amount' => 'Amount',
        ];
    }
}
