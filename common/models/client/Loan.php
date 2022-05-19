<?php

namespace common\models\client;

use Yii;
use common\models\client\ClientMasterData;
use common\models\client\Client;
use common\models\client\LoanProduct;
use yii\db\ActiveRecord;
use common\models\client\LoanCollateral;
use common\models\loan\LoanAmortization;
use common\models\loan\Ledger;
use common\models\loan\TransactionPayments;
use common\models\client\LoanManagerRemarks;
use yii\helpers\Url;
use yii\db\Query;
use yii\helpers\Html;
use common\models\loan\DecliningBalanceAmortization;
use common\models\loan\LoanPaymentSchedule;
use common\models\loan\Score;
use common\models\User;
use common\models\loan\BorrowerCheckList;
/**
 * This is the model class for table "loan".
 *
 * @property int $id
 * @property string $reference_number
 * @property int $client_id Client ID
 * @property int $loan_type
 * @property float $amount_applied_for Loan Amount Requested by the Client
 * @property string $application_date
 * @property float|null $amount_approved
 * @property string|null $disbursment_date
 * @property int $status Loan Status
 * @property float $interest_rate
 * @property string $interest_frequency
 * @property string $installment_frequency
 * @property float|null $payment_installment_amount
 * @property string|null $installment_payment_start_date
 * @property string|null $installment_payment_last_date
 * @property string|null $interest_payment_start_date
 * @property string|null $interest_payment_last_date
 * @property int $loan_period
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Loan extends \yii\db\ActiveRecord {

    const STATUS_NOTPAID=42;
     const STATUS_MERGED=74;
    const SCENARIO_APPROVE = 'approve-loan-application';

    /**
     * Activity remarks. When approving, rejecting or deferring loan applications
     */
    public $activity_remarks;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['reference_number', 'client_id', 'loan_product', 'amount_applied_for', 'currency', 'status', 'interest_rate', 'interest_frequency', 'installment_frequency', 'loan_period', 'created_at', 'created_by'], 'required'],
            [['client_id', 'loan_type', 'loan_product', 'currency', 'status', 'amortization_method', 'loan_period', 'created_at', 'created_by', 'updated_at', 'updated_by','application_payment_status','manager_submitted_at','manager_submitted_by','submitted_at','submitted_by','approved_at','approved_by'], 'integer'],
            [['amount_applied_for', 'amount_approved','balance', 'top_up_amount','interest_rate'], 'number'],
            [['disbursment_date','application_date'], 'safe'],
            [['reference_number'], 'string', 'max' => 255],
            [['interest_frequency', 'installment_frequency'], 'string', 'max' => 20],
            ['amount_approved', 'compare', 'compareValue' =>$this->amount_applied_for, 'operator' => '<=','message'=>Yii::t('app','Approved amount can not be greater than the applied amount.')],
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_APPROVE] = ['amount_approved', 'amortization_method'];
        //$scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }

    public function checkDate($attribute, $params) {
        $today = date('Y-m-d');
        $selectedDate = date($this->application_date);
        if ($selectedDate > $today) {
            $this->addError($attribute, 'Application Date Can not be greater than today!!');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'reference_number' => 'Reference Number',
            'client_id' => 'Client',
            'loan_type' => 'Loan Type',
            'amount_applied_for' => 'Amount Applied',
            'currency' => "Currency",
            'application_date' => 'Application Date',
            'amount_approved' => 'Amount Approved',
            'top_up_amount'=>'Amount',
            'disbursment_date' => 'Disbursment Date',
            'status' => 'Status',
            'disbursment_date' => 'Disbursment Due Date',
            'interest_rate' => 'Interest Rate(%)',
            'interest_frequency' => 'Interest Frequency',
            'installment_frequency' => 'Installment Frequency',
            'payment_installment_amount' => 'Payment Installment Amount',
            'installment_payment_start_date' => 'Installment Payment Start Date',
            'installment_payment_last_date' => 'Installment Payment Last Date',
            'interest_payment_start_date' => 'Interest Payment Start Date',
            'interest_payment_last_date' => 'Interest Payment Last Date',
            'amortization_method' => 'Amortization Method',
            'loan_period' => 'Loan Period(Months)',
            'loan_product' => 'Loan Product',
            'created_at' => 'Applied On',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        if ($this->isNewRecord) {
            $this->created_at = time();
            $this->created_by = Yii::$app->user->id;
        }
        return true;
    }

    /**
     * Generate a reference NUmber
     */
    public function generateReferenceNumber() {
        $prefix = "LN" . date('y');
        return $prefix . time();
    }

    public function getLoanStatus() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'status']);
    }

    public function getLoanType() {
        return $this->hasOne(LoanProduct::class, ['id' => 'loan_type']);
    }

    public function getAmortizationMethod() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'amortization_method']);
    }

    public function getClient() {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

       public function getLoanGuarantor() {
        return $this->hasMany(LoanGuarantor::class, ['loan_id' => 'id']);
    }
    
         public function getLoanOfficerRemarks() {
        return $this->hasMany(LoanManagerRemarks::class, ['loan_id' => 'id'])->where(['remarks_status'=>3]);
    }
    
      
         public function getCreditManagerRemarks() {
        return $this->hasMany(LoanManagerRemarks::class, ['loan_id' => 'id'])->where(['remarks_status'=>3]);
    }
    
 

         public function getLoanCollateral() {
        return $this->hasMany(LoanCollateral::class, ['loan_id' => 'id']);
    }


    /**

     * Generate the payment schedule from the application information

     * @param $method The Armortization method [1=Staright Line, 2=Declining Balance]

     */
    public function getPaymentSchedule($method = 1) {

        switch ($method) {

            case 1: //Straight Line

                $schedule = new LoanAmortization();

                $schedule->setPrincipal($this->amount_approved); //Principal

                $schedule->setTerm($this->loan_period); //Number of months

                $schedule->setInterestRate($this->interest_rate / 100); //Interest Rate

                return $schedule->getBreakdownByMonth();

                break;

            case 2: //Reducing Balance

                $schedule = new DecliningBalanceAmortization(
                        [
                    'months' => $this->loan_period,
                    'amount_disbursed' => $this->amount_approved,
                    'interest_rate' => ($this->interest_rate / 100),
                    'start_date' => $this->disbursment_date
                ]);

                return $schedule->getBreakdownByMonth();

                break;
        }
    }

    public function getLedgerEntries() {
        return $this->hasMany(Ledger::class, ['entry_reference_id' => 'id'])->where(['entry_type' => "LOAN"]);
    }
    
        public function getPenaltiesEntries() {
        return $this->hasMany(Ledger::class, ['entry_reference_id' => 'id'])->where(['entry_type' => "LOAN",'debit_account'=>41223]);
    }
    
        public function getPaymentEntries() {
        return $this->hasMany(TransactionPayments::class, ['loan_id' => 'id']);
    }
    
    
      public function getLoanScheduleEntries() {
        return $this->hasMany(LoanPaymentSchedule::class, ['loan_id' => 'id']);
    }
    
    
     public function getLoanLedgerEntries() {
        return $this->hasMany(Ledger::class, ['entry_reference_id' => 'id']);
    }
      
      public function getLoanRatedItems() {
        return $this->hasMany(Score::class, ['loan_id' => 'id']);
    }
 
    
        public function getBorrowerRequirement() {
        return $this->hasMany(BorrowerCheckList::class, ['loan_id' => 'id'])->where(['category'=>"BORROWER"]);
    }
     
        public function getBorrowerRequirementList() {
        return $this->hasMany(BorrowerCheckList::class, ['loan_id' => 'id'])->where(['category'=>"BORROWER",'status'=>1]);
    }
 
    
      public function getGurantorRequirement() {
        return $this->hasMany(BorrowerCheckList::class, ['loan_id' => 'id'])->where(['category'=>"GUARANTOR"]);
    }
 
 
    /**
     * Show Status Button 
     */
    public function getStatusButton() {
        return "<badge class='badge badge-{$this->loanStatus->css_class}'>" . $this->loanStatus->name . '</badge>';
    }

    /**
     * Transaction formartted in UGX
     */
    public function getAmountApplied() {
        return number_format($this->amount_applied_for);
    }
    
    /**
     * Submitted On Loan officer
     */
        public function getSubmittedOn() {
        return date('d-m-Y',$this->submitted_at);
    }
    
        /**
     * Submitted On Loan officer
     */
        public function getManagerSubmittedOn() {
        return date('d-m-Y',$this->manager_submitted_at);
    }
    
        
        /**
     * Approved On by Director
     */
        public function getApprovedOn() {
        return date('d-m-Y',$this->approved_at);
    }
    
      
       /**
     * Approved By Director
     */
      
      public function getApprovedBy() {
        return $this->hasOne(User::class, ['id' => 'approved_by']);
    }
    
    
       /**
     * Show User Names 
     */
    public function getDirectorUserNames() {
        return $this->approvedBy->firstname . ' ' . $this->approvedBy->lastname;
    }
       /**
     * Submitted By Loan officer
     */
      
      public function getSubmittedBy() {
        return $this->hasOne(User::class, ['id' => 'submitted_by']);
    }
    
          public function getCreatedBy() {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
    
        /**
     * Submitted By Loan officer
     */
      
      public function getManagerSubmittedBy() {
        return $this->hasOne(User::class, ['id' => 'manager_submitted_by']);
    }
 
       /**
     * Show User Names 
     */
    public function getManagerUserNames() {
        return $this->managerSubmittedBy->firstname . ' ' . $this->managerSubmittedBy->lastname;
    }
    
          /**
     * Show User Names 
     */
    public function getUserNames() {
        return $this->submittedBy->firstname . ' ' . $this->submittedBy->lastname;
    }
    
    
              /**
     * Show User Names 
     */
    public function getLoanOfficerNames() {
        return $this->createdBy->firstname . ' ' . $this->createdBy->lastname;
    }
    
    
    
     /**
     * Transaction formartted in UGX
     */
    public function getAmountBalance() {
        return number_format($this->amount_applied_for-Loan::getTotalPrincipalPaid($id));
    }
    
    
      public static function getTotalPrincipalPaid($id) {
        $query = new Query();
        $query->select("SUM(amount) AS principal_paid");
        $query->from('ledger');
        $query->where("credit_account = '11300'");
        $query->andWhere(['entry_reference_id' => $id]);
        $query->andWhere(['ledger_status' => 42]);
        return $query->one();
    }
    
        public static function getTotalPrincipal($id) {
        $query = new Query();
        $query->select("SUM(principal_amount) AS principal_due");
        $query->from('loan_payment_schedule');
        $query->where("principal_dr_account = '11110'");
        $query->andWhere(['loan_id' => $id]);
        return $query->one();
    }
    
       public static function getPrincipalPaid($id) {
        $query = new Query();
        $query->select("SUM(principal_paid) AS principal_paid");
        $query->from('loan_payment_schedule');
        $query->where("principal_cr_account = '11300'");
        $query->andWhere(['loan_id' => $id]);
        return $query->one();
    }
    
    
    
        public static function getTotalInterest($id) {
        $query = new Query();
        $query->select("SUM(interest_amount) AS interest_due");
        $query->from('loan_payment_schedule');
        $query->where("interest_dr_account = '12210'");
        $query->andWhere(['loan_id' => $id]);
        return $query->one();
    }
    
    
        public static function getTotalInterestPaid($id) {
        $query = new Query();
        $query->select("SUM(interest_paid) AS interest_paid");
        $query->from('loan_payment_schedule');
        $query->where("interest_cr_account = '41110'");
        $query->andWhere(['loan_id' => $id]);
        return $query->one();
    }
    
    

    
         public static function getTotalRate($id) {
        $query = new Query();
        $query->select("SUM(mark) AS total_rate");
        $query->from('score');
        $query->andWhere(['loan_id' => $id]);
        return $query->one();
    }

    

    /**
     * Show Client Names 
     */
    public function getFullNames() {
        return $this->client->firstname . ' ' . $this->client->lastname;
    }

    /**
     * Get LOan Reference Number  Link
     */
    public function getReferenceNumber() {
        return '<b><a href="' . Url::to(['loan/view', 'id' => $this->id]) . '">' . $this->reference_number . "</a></b>";
    }
    
      public function getPassportPhoto() {
        if (!empty($this->client->passport_photo)) {
            return Yii::getAlias('@web/html') . "/passport/" . $this->client->passport_photo;
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
     * Chckebox field used for the first column
     * @return type
     */
    public function getCheckboxField() {
            return Html::checkbox('row' . $this->id, false, 
            [
                'label' => false, 
                'id' => 'row' . $this->id, 
                'value' => $this->id,
                'disabled'=>($this->status>self::STATUS_NOTPAID)
            ]);
    }

    /**
     * Amount Applied
     */
    public function getAmountApproved() {
        return number_format($this->amount_approved);
    }
    
 
    
 

}
