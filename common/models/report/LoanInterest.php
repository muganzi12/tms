<?php

namespace common\models\report;

use Yii;
use common\models\client\ClientMasterData;
use common\models\client\Loan;
/**
 * This is the model class for table "loan_interset".
 *
 * @property int $id
 * @property string $description
 * @property int $entry_reference Ref Number for this transaction. This Ref number is used to know the specific transactions which were handled together, e.g. payment of a loan (principle and interest) these should have the same ref number
 * @property float $amount
 * @property int $debit_account
 * @property int|null $credit_account
 * @property string $due_date Date when this payment is due
 * @property string $entry_type Is this a loan, payment, Investor deposit, etc?
 * @property int $entry_reference_id
 * @property int $created_at
 * @property int|null $created_by
 * @property string|null $member_account
 * @property int|null $entry_period The accounting period for which this entry was made, could be a financial year e.g. 2021, calendar year like 2021 or Year-Month like 2101
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int $ledger_status
 * @property int|null $interest_status
 * @property string|null $cancel_interest_reason
 * @property int|null $payment_ref Payment reference for this ledger item
 */
class LoanInterest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loan_interest';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entry_reference', 'debit_account', 'credit_account', 'entry_reference_id', 'created_at', 'created_by', 'entry_period', 'updated_at', 'updated_by', 'ledger_status', 'interest_status', 'payment_ref'], 'integer'],
            [['description', 'entry_reference', 'amount', 'debit_account', 'due_date', 'entry_type', 'entry_reference_id', 'created_at'], 'required'],
            [['amount'], 'number'],
            [['due_date'], 'safe'],
            [['description', 'cancel_interest_reason'], 'string', 'max' => 255],
            [['entry_type'], 'string', 'max' => 20],
            [['member_account'], 'string', 'max' => 45],
        ];
    }
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'entry_reference' => 'Entry Reference',
            'amount' => 'Amount',
            'debit_account' => 'Debit Account',
            'credit_account' => 'Credit Account',
            'due_date' => 'Due Date',
            'entry_type' => 'Entry Type',
            'entry_reference_id' => 'Entry Reference ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'member_account' => 'Member Account',
            'entry_period' => 'Entry Period',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'ledger_status' => 'Ledger Status',
            'interest_status' => 'Interest Status',
            'cancel_interest_reason' => 'Cancel Interest Reason',
            'payment_ref' => 'Payment Ref',
        ];
    }
    
      /**
    * Due Date formatted 
    */
    public function getTransactionDueDate(){
        return Yii::$app->formatter->asDate($this->due_date).'</br><span style="color:#068;font-size:85%;">'.Yii::$app->formatter->asRelativeTime($this->due_date)."</span>";
    }
    
        /**
     * Transaction formartted in UGX
     */
    public function getTransactionAmount(){
        return Yii::$app->formatter->asCurrency($this->amount,'UGX');
    }
    
       /**
    * Show Status Button 
    */
    public function getStatusButton(){
        return "<badge class='badge badge-{$this->ledgerStatus->css_class}'>".$this->ledgerStatus->name.'</badge>';
    }

    /**
     * Status of the ledger record
     */
    public function getLedgerStatus() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'ledger_status']);
    }
    
       public function getLoan() {
        return $this->hasOne(Loan::class, ['id' => 'entry_reference_id']);
    }

    
        /**
     * Show Client Names 
     */
    public function getFullNames() {
        return $this->loan->client->firstname . ' ' . $this->loan->client->lastname;
    }
}
