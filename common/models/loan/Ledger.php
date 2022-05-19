<?php

namespace common\models\loan;

use Yii;
use yii\helpers\Html;
use common\models\client\ClientMasterData;
use yii\helpers\Url;
use common\models\client\Loan;
use common\models\loan\LoanPaymentSchedule;
/**
 * This is the model class for table "ledger".
 *
 * @property int $id
 * @property int $entry_reference Ref Number for this transaction. This Ref number is used to know the specific transactions which were handled together, e.g. payment of a loan (principle and interest) these should have the same ref number
 * @property float $amount
 * @property string $debit_account
 * @property string $credit_account
 * @property int $entry_type Is this a loan, payment, Investor deposit, etc?
 * @property int $entry_reference_id
 * @property int $created_at
 * @property int|null $created_by
 * @property string|null $member_account
 * @property int|null $entry_period The accounting period for which this entry was made, could be a financial year e.g. 2021, calendar year like 2021 or Year-Month like 2101
 **/
class Ledger extends \yii\db\ActiveRecord
{
    const STATUS_NOTPAID=42;
    const STATUS_APPROVED=20;
    const STATUS_PAID=43;
    const STATUS_CANCELLED=44;
    const STATUS_REJECTED=36;
    const STATUS_REVERSED=45;
   const STATUS_DISBURSED=41;
    const STATUS_FULLYPAID=86;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ledger';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount','entry_type','stage','debit_account', 'entry_reference_id'], 'required'],
            [['entry_reference','entry_reference_id','schedule_id', 'sub_ledger','created_at', 'created_by', 'entry_period','updated_at','updated_by','ledger_status'], 'integer'],
            [['amount','balance'], 'number'],
            [['due_date','next_date'], 'safe'],
            [['description','entry_reference','cancel_interest_reason','debit_account', 'credit_account', 'member_account','entry_type','stage'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert){
        if($this->isNewRecord){
            $this->setEntryPeriod();
            $this->created_at = time();
            $this->created_by = Yii::$app->member->id;
        }else{
            $this->updated_at = time();
            $this->updated_by = Yii::$app->member->id;
        }
    return parent::beforeSave($insert);
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entry_reference' => 'Entry Reference',
            'amount' => 'Amount',
            'debit_account' => 'Debit Account',
            'credit_account' => 'Credit Account',
            'entry_type' => 'Entry Type',
            'entry_reference_id' => 'Entry Reference ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'member_account' => 'Member Account',
            'entry_period' => 'Entry Period',
            'cancel_interest_reason'=>'Give a reason for updating this record',
            'updated_at'=>'Last updated at',
            'updated_by'=>'Last updated by',
            'ledger_status'=>'Status',
            'due_date'=>'Due Date'
        ];
    }

    public function setEntryPeriod(){
        $this->entry_period=date('Y');
    }

    /**
     * Chckebox field used for the first column
     * @return type
     */
    public function getCheckboxField() {
            return Html::checkbox('row' . $this->id, false, 
            [
                'label' => false, 
                'id' => 'row' . $this->id, 
                'value' => $this->id,
                'disabled'=>($this->ledger_status<self::STATUS_PAID)
            ]);
    }

    /**
     * Transaction formartted in UGX
     */
    public function getTransactionAmount(){
        return Yii::$app->formatter->asCurrency($this->amount,'UGX');
    }
    
        /**
     * Transaction formartted in UGX
     */
    public function getAmountPaid(){
        return Yii::$app->formatter->asCurrency($this->amount_paid,'UGX');
    }
    
    /**
    * Due Date formatted 
    */
    public function getTransactionDueDate(){
        return Yii::$app->formatter->asDate($this->due_date).'</br><span style="color:#068;font-size:85%;">'.Yii::$app->formatter->asRelativeTime($this->due_date)."</span>";
    }

    /**
    * Due Date formatted 
    */
    public function getTransactionDate(){
        return Yii::$app->formatter->asDate($this->created_at);
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
    
             /**
     * Show Client Names 
     */
    public function getFullNames() {
        return $this->loanLedger->client->firstname . ' ' . $this->loanLedger->client->lastname;
    }
    
    
     /**
     * Associated Loan 
     */
    public function getLoanLedger() {
        return $this->hasOne(Loan::class, ['id' => 'entry_reference_id']);
    }
    
      /**
     * Associated Loan 
     */
    public function getLoanSchedule() {
        return $this->hasOne(LoanPaymentSchedule::class, ['id' => 'schedule_id']);
    }
    
    
       /**
     * Get Update Interest Status  Link
     */
    public function getInterestButton() {
     
             return '<b><a href="' . Url::to(['loan/update-interest', 'id' => $this->id,'ln'=>$this->loanLedger->id]) . '">' . 'Edit' . "</a></b>";
    
    }
    
        public function getPassportPhoto() {
        if (!empty($this->client->passport_photo)) {
            return Yii::getAlias('@web/html') . "/passport/" . $this->loanLedger->client->passport_photo;
        } else {
            return Yii::getAlias('@web/html') . "/passport/default.jpeg";
        }
    }
    
    
    /**
     * 
     * Show Client Classification Status
     */
    public function getProfile() {
        $url = $this->passportPhoto;
        return Html::img($url, ['alt' => 'avatar', 'width' => '50', 'height' => '50']);
    }
    
    
  
    
    /**
     * Status of the ledger record
     */
    public function getInterestStatus() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'ledger_status']);
    }
    
    
     /**
     * Over due Payments
     */
    public static function getOverDuePayments() {
        $sql = "SELECT *
                FROM ledger
                WHERE (debit_account='11110' OR debit_account='12210') AND ledger_status=42 AND due_date < curdate() ORDER BY created_at ASC";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
    
       /**
     * Over due Payments
     */
    public static function getOverTotalAmount() {
        $sql = "SELECT sum(amount)
                FROM ledger
                WHERE (debit_account='11110' OR debit_account='12210') AND ledger_status=42 AND due_date < curdate() ORDER BY created_at ASC";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
  
    

    
    public static function getPrincipalDue() {
        $db = Yii::$app->getDb();
        $sql = "SELECT SUM(amount) AS amount,ledger.entry_reference_id,ledger.member_account,ledger.entry_period,loan.reference_number,loan.client_id,loan.loan_period,loan.status,CONCAT(client.lastname,' ',client.firstname,'',client.othername) AS clientname
                FROM `ledger`INNER JOIN loan ON ledger.entry_reference_id=loan.id JOIN client ON client.id = loan.client_id WHERE debit_account=11110 AND ledger_status=42
                GROUP BY ledger.entry_reference_id,ledger.member_account,ledger.entry_period,loan.reference_number,loan.client_id,loan.loan_period,loan.status
                ORDER BY 1 DESC
                ";
        $command = $db->createCommand($sql);
        return $command->queryAll();
    }
    
       public static function getPrincipalPayments() {
        $db = Yii::$app->getDb();
        $sql = "SELECT SUM(amount) AS amount,ledger.entry_reference_id,ledger.member_account,ledger.entry_period,loan.reference_number,loan.client_id,loan.loan_period,loan.status,CONCAT(client.lastname,' ',client.firstname,'',client.othername) AS clientname
                FROM `ledger`INNER JOIN loan ON ledger.entry_reference_id=loan.id JOIN client ON client.id = loan.client_id WHERE debit_account=11110 AND ledger_status=43
                GROUP BY ledger.entry_reference_id,ledger.member_account,ledger.entry_period,loan.reference_number,loan.client_id,loan.loan_period,loan.status
                ORDER BY 1 DESC
                ";
        $command = $db->createCommand($sql);
        return $command->queryAll();
    }
    
}
