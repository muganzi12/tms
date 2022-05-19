<?php
namespace common\models\loan;

use Yii;
use yii\base\Model;
use yii\db\Query;
use common\models\client\ChartOfAccounts;
use common\models\client\Loan;
/**
 * Helper class for the General Ledger
 */
class LedgerHelper extends Model {
    /**
     * Uniqur ID of the loan product
     */
 private $product_id;
 /**
  * Tag. The loan stage in the lifecycle
  */
 public $tag;
 /**
  * Loan Principal Amount
  */
 private $principal;

 /**
  * The loan we are working on
  */
 public $loan_id;

 /**
  * Loan Application
  */
 public $loan;

 /**
  * Account used for advance payments
  */
const ACCOUNTS_ADVANCEPAYMENTS=24100;

 public function __construct($config=[]){
        parent::__construct($config); 
        $this->setLoanAttributes();
 }

    protected function setLoanAttributes(){
        $this->loan = Loan::findOne($this->loan_id);
        $this->principal=$this->loan->amount_approved;
        $this->product_id=$this->loan->loan_type;
    }

    public function prepareLoanLedgerEntry(){
        $entries=[];
        $refNumber = $this->setNextReferenceNumber();
        foreach($this->loanTransactionConfig AS $config){
        $entries[] = new Ledger(
            [
            'amount' => $this->setLedgerAmount($config->amount_rule,$config->amount),
            'debit_account' => $config->debit_account,
            'credit_account' => $config->credit_account,
            'entry_type' => $config->product_type,
            'entry_reference_id' => $this->loan_id,
            'member_account' => $this->loan->client->account_number,
            'entry_reference'=>$refNumber,
            'due_date'=>date('Y-m-d')
            ]
        );
        }
        return $entries;
    }

    public function prepareLoanScheduleEntries(){
        //$loan
        $schedule = Loan::findOne($this->loan_id)->getPaymentSchedule();
        $principalConfig = LedgerTransactionConfig::transactionByTag($this->product_id,'principal');
        $interestConfig = LedgerTransactionConfig::transactionByTag($this->product_id,'interest');
        //Entries
        $entries=[];
        $refNumber = $this->setNextReferenceNumber();
        $ref_num=0;
        foreach($schedule AS $sch){
            $scheduleEntry = $sch->jsonSerialize();
            //Principle
        $entries[] = new Ledger(
            [
            'amount' => $this->setLedgerAmount('FIXED',$scheduleEntry['principalRounded']),
            'debit_account' => $principalConfig[0]->debit_account,
            'credit_account' => $principalConfig[0]->credit_account,
            'entry_type' => $principalConfig[0]->product_type,
            'entry_reference_id' => $this->loan_id,
            'member_account' => $this->loan->client->account_number,
            'entry_reference'=>$refNumber+$ref_num,
            'due_date'=>$scheduleEntry['date']
            ]
        );
        //Interest
        $entries[] = new Ledger(
            [
            'amount' => $this->setLedgerAmount('FIXED',$scheduleEntry['interestRounded']),
            'debit_account' => $interestConfig[0]->debit_account,
            'credit_account' => $interestConfig[0]->credit_account,
            'entry_type' => $interestConfig[0]->product_type,
            'entry_reference_id' => $this->loan_id,
            'member_account' => $this->loan->client->account_number,
            'entry_reference'=>$refNumber+$ref_num,
            'due_date'=>$scheduleEntry['date']
            ]
        );
        $ref_num+=1;
        }
        return $entries;
    }

    /**
     * Prepare ledger records for loan payments
     */
    public function prepareLoanPayment($ledgers,$amount){
        //$loan
        $schedule = Loan::findOne($this->loan_id)->getPaymentSchedule();
        $principalConfig = LedgerTransactionConfig::transactionByTag($this->product_id,'principal');
        $interestConfig = LedgerTransactionConfig::transactionByTag($this->product_id,'interest');
        //Entries
        $entries=[];
        $refNumber = $this->setNextReferenceNumber();
        $ref_num=0;
        foreach($schedule AS $sch){
            $scheduleEntry = $sch->jsonSerialize();
            //Principle
        $entries[] = new Ledger(
            [
            'amount' => $this->setLedgerAmount('FIXED',$scheduleEntry['principalRounded']),
            'debit_account' => $principalConfig[0]->debit_account,
            'credit_account' => $principalConfig[0]->credit_account,
            'entry_type' => $principalConfig[0]->product_type,
            'entry_reference_id' => $this->loan_id,
            'member_account' => $this->loan->client->account_number,
            'entry_reference'=>$refNumber+$ref_num,
            'due_date'=>$scheduleEntry['date']
            ]
        );
        $ref_num+=1;
        }
        return $entries;
    }

    /**
     * Set the Ledger Amount
     */
    protected function setLedgerAmount($method,$amount=0){
        $ledger_amount=0;
        switch($this->tag){
            case 'disbursement':
                $ledger_amount = $this->principal;
                break;

                default:
            switch($method){
                case 'PERCENTAGE':
                    $ledger_amount = $this->principal*($amount/100);
                    break;
                    
                case 'FIXED';
                default:
                $ledger_amount=$amount;
                break;
            }
         break;
        }

        return $ledger_amount;
    }

    /**
     * Configuration
     */
    protected function getLoanTransactionConfig(){
        return LedgerTransactionConfig::transactionByTag($this->product_id,$this->tag);
    }

        /**
        * The next transaction Reference Number
        */
    public function setNextReferenceNumber(){
        $max = Ledger::find()->orderBy(['id'=>SORT_DESC])->one();
        $lastref = is_object($max)?($max->entry_reference):(10000000000000);
        return $lastref+1;
    }
   
    /**
    * Prepare records for the (Ledger/Payments) Junction table
    */
    public static function setLedgerPayment($payment,$ledgers){
        $payments=[];
        foreach($ledgers AS $lg){
        $payments[] = new Ledger(
                [
                    'amount' => $lg->amount,
                    'debit_account' => $payment->debit_account,
                    'credit_account' => $lg->debit_account,
                    'entry_type' => $lg->entry_type,
                    'entry_reference_id' => $lg->entry_reference_id,
                    'member_account' => $lg->member_account,
                    'entry_reference'=>$lg->entry_reference,
                    'due_date'=>$lg->due_date,
                    'description'=>$lg->description.' - settled',
                    'payment_ref'=>$payment->reference_no,
                    'ledger_status'=>Ledger::STATUS_PAID
                ]
            );
        }
        //Do we have any Advance Payments?
        if($payment->advance_payment>0){
            $payments[] = new Ledger(
                [
                    'amount' => $payment->advance_payment,
                    'debit_account' => self::ACCOUNTS_ADVANCEPAYMENTS,
                    'credit_account' => $payment->debit_account,
                    'entry_type' => $lg->entry_type,
                    'entry_reference_id' => $lg->entry_reference_id,
                    'member_account' => $lg->member_account,
                    'entry_reference'=>$lg->entry_reference,
                    'due_date'=>date('Y-m-d'),
                    'description'=>'Advance loan payment',
                    'payment_ref'=>$payment->reference_no,
                    'ledger_status'=>Ledger::STATUS_PAID
                ]
            );
        }
        return $payments;
    }
}