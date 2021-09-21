<?php

namespace common\models\loan;

use Yii;

/**
 * This is the model class for table "ledger_payment".
 *
 * @property int $id
 * @property int $reference_no Unique reference number for this transaction
 * @property string $paid_by Name of person who made this payment
 * @property int $payment_method
 * @property float $amount_paid
 * @property string $payment_date
 * @property int $debit_account
 * @property string|null $description
 * @property string|null $proof_attachment
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_by
 * @property int|null $updated_at
 */
class LedgerPayment extends \yii\db\ActiveRecord
{
    /**
     * IDs of ledger records
     */
    public $ledgers;

    /**
     * Total amount of money expected/billed
     */
    public $bill_total;


    /**
     * Amount paid in advance
     */
    public $advance_payment;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ledger_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reference_no', 'paid_by', 'payment_method', 'amount_paid', 'payment_date', 'debit_account', 'created_at', 'created_by'], 'required'],
            [['id', 'reference_no', 'payment_method', 'debit_account', 'created_at', 'created_by', 'updated_by', 'updated_at'], 'integer'],
            [['amount_paid','bill_total','advance_payment'], 'number'],
            [['payment_date'], 'safe'],
            [['description','ledgers'], 'string'],
            [['paid_by', 'proof_attachment'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reference_no' => 'Reference No',
            'paid_by' => 'Paid By',
            'payment_method' => 'Payment Method',
            'amount_paid' => 'Amount Paid',
            'payment_date' => 'Payment Date',
            'debit_account' => 'Debit Account',
            'description' => 'Description',
            'proof_attachment' => 'Proof of attachment',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert){
        if($this->isNewRecord){
            $this->created_at =time();
            $this->created_by=Yii::$app->member->id;
        }else{
            $this->updated_at = time();
            $this->updated_by = Yii::$app->member->id;
        }
    return parent::beforeSave($insert);
    }
}
