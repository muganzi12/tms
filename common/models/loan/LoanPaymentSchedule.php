<?php

namespace common\models\loan;

use Yii;
use yii\helpers\Url;
use common\models\loan\Ledger;
use common\models\client\Loan;
use common\models\loan\LedgerPayment;
use yii\db\Query;
/**
 * This is the model class for table "loan_payment_schedule".
 *
 * @property int $id
 * @property int $loan_id
 * @property string $due_date
 * @property int $status
 * @property float $principal_amount
 * @property float $interest_amount
 * @property float $principal_paid
 * @property float $interest_paid
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
            [['loan_id', 'due_date', 'principal_amount', 'interest_amount', 'principal_paid','interest_paid','status', 'created_at', 'created_by'], 'required'],
            [['loan_id', 'created_at', 'created_by', 'updated_at', 'updated_by','principal_dr_account','principal_cr_account','interest_dr_account','interest_cr_account', ], 'integer'],
            [['due_date','next_date'], 'safe'],
            [['principal_amount', 'interest_amount', 'principal_paid', 'interest_paid'], 'number'],
        ];
    }
    
      /**
     * {@inheritdoc}
     */
    public function beforeSave($insert){
        if($this->isNewRecord){
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
            'loan_id' => 'Loan ID',
            'due_date' => 'Due Date',
            'status'=>'Status',
            'principal_amount' => 'Principal Amount',
            'interest_amount' => 'Interest Amount',
            'principal_paid' => 'Principal Paid',
            'interest_paid' => 'Interest Paid',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
   
          public function getInterestButton() {
        return '<b><a href="' . Url::to(['loan/view-payments', 'id' => $this->id]) . '">' . 'View' . "</a></b>";
    }
    
       public function getReferenceNumber() {
        return '<b><a href="' . Url::to(['loan/view-payments', 'id' => $this->id]) . '">' . $this->due_date . "</a></b>";
    }
    
       public function getLoanScheduleEntries() {
        return $this->hasMany(Ledger::class, ['schedule_id' => 'id'])->where(['entry_type' => "LOAN"]);
       }
       
     public function getLedgerLoanScheduleEntries() {
        return $this->hasMany(Ledger::class, ['schedule_id' => 'id'])->where(['entry_type' => "PAYMENT"]);
       }
     public function getLoan() {
        return $this->HasOne(Loan::class, ['id' => 'loan_id']);
    }
    

    
       public function prepareLoanScheduleEntries() {
        //$loan
        $schedule = Loan::findOne($this->loan_id)->getPaymentSchedule(2);
        $principalConfig = LedgerTransactionConfig::transactionByTag($this->product_id, 'principal');
        $interestConfig = LedgerTransactionConfig::transactionByTag($this->product_id, 'interest');
        //Entries
        $entries = [];
        $refNumber = $this->setNextReferenceNumber();
        $ref_num = 1;
   
            $entries[] = new Ledger(
                    [
                'amount' => $this->setLedgerAmount('FIXED', $scheduleEntry['principalRounded']),
                'debit_account' => $principalConfig[0]->debit_account,
                'credit_account' => $principalConfig[0]->credit_account,
                'entry_type' => $principalConfig[0]->product_type,
                'entry_reference_id' => $this->loan_id,
                'stage' => 'DISBURSEMENT',
                'member_account' => $this->loan->client->account_number,
                'description' => @$principalConfig[0]->transactionLabel->name . ' ' . $ref_num,
                'entry_reference' => $refNumber + $ref_num,
                'interest_status' => Ledger::STATUS_NOTPAID,
                'ledger_status' => Ledger::STATUS_NOTPAID,
                'due_date' => $scheduleEntry['date'],
                'next_date' => date("Y-m-d",strtotime($scheduleEntry['date'] . "+1 Day")),
                    ]
            );
            //Interest
            $entries[] = new Ledger(
                    [
                'amount' => $this->setLedgerAmount('FIXED', $scheduleEntry['interestRounded']),
                'debit_account' => $interestConfig[0]->debit_account,
                'credit_account' => $interestConfig[0]->credit_account,
                'entry_type' => $interestConfig[0]->product_type,
                'stage' => 'DISBURSEMENT',
                'entry_reference_id' => $this->loan_id,
                'member_account' => $this->loan->client->account_number,
                'description' => @$interestConfig[0]->transactionLabel->name . ' ' . $ref_num,
                'entry_reference' => $refNumber + $ref_num,
                'interest_status' => Ledger::STATUS_NOTPAID,
                'ledger_status' => Ledger::STATUS_NOTPAID,
                'due_date' => $scheduleEntry['date'],
                'next_date' => date("Y-m-d",strtotime($scheduleEntry['date'] . "+1 Day")),
                    ]
            );
            $ref_num += 1;
        
        return $entries;
    }
    
        /**
     * Configuration
     */
    protected function getLoanTransactionConfig() {
        return LoanPaymentSchedule::transactionByTag($this->schedule_id);
    }
    
       /**
     * The next transaction Reference Number
     */
    public static function setNextReferenceNumber() {
        $max = Ledger::find()->orderBy(['id' => SORT_DESC])->one();
        $lastref = is_object($max) ? ($max->entry_reference) : (10000000000000);
        return $lastref + 1;
    }
    
      /**
     * Get the config rules for a loan product by Tag
     */
    public static function transactionByTag($id,$product='LOAN'){
        return Ledger::find()
                ->where(['entry_type'=>$product,'schedule_id'=>$id])
                ->all();
    }
    
    
        /**
     * Registration Documents presented by this client
     * @return CompanyDocument
     */
    public function getSupportingDocuments() {
        return $this->hasMany(LedgerPayment::className(), ['schedule_id' => 'id']);
    }
    
        
      public function getAgingReport() {
        return Yii::$app->db->createCommand("SELECT SUM(principal_amount) AS principal_amount, SUM(principal_paid) AS principal_paid,SUM(interest_amount) AS interest_amount, SUM(interest_paid) AS interest_paid,DATEDIFF(CURRENT_DATE,next_date) AS days
                 ,loan_payment_schedule.loan_id,loan_payment_schedule.next_date,loan.reference_number,loan.client_id,loan.loan_period,loan.status,CONCAT(client.lastname,' ',client.firstname,' ',client.othername) AS clientname
                FROM `loan_payment_schedule`INNER JOIN loan ON loan_payment_schedule.loan_id=loan.id JOIN client ON client.id = loan.client_id WHERE principal_dr_account=11110
                GROUP BY loan_payment_schedule.loan_id,loan_payment_schedule.next_date,loan.reference_number,loan.amount_approved,loan.client_id,loan.loan_period,loan.status
                ORDER BY 1 DESC")->queryAll();
    }
    
    public static function getTotalPrincipal() {
        $query = new Query();
        $query->select("SUM(principal_amount) AS principal_due");
        $query->from('loan_payment_schedule');
        $query->where("principal_dr_account = '11110'");
        return $query->one();
    }
    
       public static function getPrincipalPaid() {
        $query = new Query();
        $query->select("SUM(principal_paid) AS principal_paid");
        $query->from('loan_payment_schedule');
        $query->where("principal_cr_account = '11300'");
        return $query->one();
    }
    
      
        public static function getTotalInterest() {
        $query = new Query();
        $query->select("SUM(interest_amount) AS interest_due");
        $query->from('loan_payment_schedule');
        $query->where("interest_dr_account = '12210'");
        return $query->one();
    }
    
    
        public static function getTotalInterestPaid() {
        $query = new Query();
        $query->select("SUM(interest_paid) AS interest_paid");
        $query->from('loan_payment_schedule');
        $query->where("interest_cr_account = '41110'");
        return $query->one();
    }
    
     public static function getTotalPrincipal30() {
        $query = new Query();
        $query->select("SUM(principal_amount) AS principal_30");
        $query->from('loan_payment_schedule');
        $query->where("DATEDIFF(CURRENT_DATE,next_date) >= '0'");
        $query->andWhere("DATEDIFF(CURRENT_DATE,next_date) <= '30'");
        return $query->one();
    }
    
        public static function getTotalPrincipalPaid30() {
        $query = new Query();
        $query->select("SUM(principal_paid) AS principal_paid_30");
        $query->from('loan_payment_schedule');
        $query->where("DATEDIFF(CURRENT_DATE,next_date) >= '0'");
         $query->andWhere("DATEDIFF(CURRENT_DATE,next_date) <= '30'");
        return $query->one();
    }

         public static function getTotalPrincipal60() {
        $query = new Query();
        $query->select("SUM(principal_amount) AS principal_60");
        $query->from('loan_payment_schedule');
        $query->where("DATEDIFF(CURRENT_DATE,next_date) >= '30'");
        $query->andWhere("DATEDIFF(CURRENT_DATE,next_date) <= '60'");
        return $query->one();
    }
    
        public static function getTotalPrincipalPaid60() {
        $query = new Query();
        $query->select("SUM(principal_paid) AS principal_paid_60");
        $query->from('loan_payment_schedule');
        $query->where("DATEDIFF(CURRENT_DATE,next_date) >= '30'");
         $query->andWhere("DATEDIFF(CURRENT_DATE,next_date) <= '60'");
        return $query->one();
    }
    
         public static function getTotalPrincipal61() {
        $query = new Query();
        $query->select("SUM(principal_amount) AS principal_61");
        $query->from('loan_payment_schedule');
        $query->where("DATEDIFF(CURRENT_DATE,next_date) >= '60'");
        $query->andWhere("DATEDIFF(CURRENT_DATE,next_date) <= '90'");
        return $query->one();
    }
    
        public static function getTotalPrincipalPaid61() {
        $query = new Query();
        $query->select("SUM(principal_paid) AS principal_paid_61");
        $query->from('loan_payment_schedule');
        $query->where("DATEDIFF(CURRENT_DATE,next_date) >= '60'");
         $query->andWhere("DATEDIFF(CURRENT_DATE,next_date) <= '90'");
        return $query->one();
    }
    
    
           public static function getTotalPrincipal90() {
        $query = new Query();
        $query->select("SUM(principal_amount) AS principal_90");
        $query->from('loan_payment_schedule');
        $query->where("DATEDIFF(CURRENT_DATE,next_date) > '90'");
        return $query->one();
    }
    
        public static function getTotalPrincipalPaid90() {
        $query = new Query();
        $query->select("SUM(principal_paid) AS principal_paid_90");
        $query->from('loan_payment_schedule');
        $query->where("DATEDIFF(CURRENT_DATE,next_date) > '90'");
        return $query->one();
    }



    
 
 
    
}
