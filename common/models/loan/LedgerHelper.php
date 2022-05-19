<?php

namespace common\models\loan;

use Yii;
use yii\base\Model;
use yii\db\Query;
use common\models\client\ChartOfAccounts;
use common\models\client\Loan;
use common\models\client\Investment;
use common\models\loan\LoanPaymentSchedule;
use common\models\loan\Score;
use common\models\loan\BorrowRequirements;
use common\models\loan\BorrowerCheckList;

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
    public $id;

    /**
     * Loan Principal Amount
     */
    private $principal;

    /**
     * The loan we are working on
     */
    public $loan_id;
    public $schedule_id;

    /**
     * The Investment we are working on
     */
    public $investment_id;

    /**
     * Loan Application
     */
    public $loan;

    /**
     * Investment Application
     */
    public $investment;

    /**
     * Account used for advance payments
     */
    const ACCOUNTS_ADVANCEPAYMENTS = 24100;

    public function __construct($config = []) {
        parent::__construct($config);
        $this->setLoanAttributes();
    }

    protected function setLoanAttributes() {
        $this->loan = Loan::findOne($this->loan_id);
        $this->principal = @$this->loan->amount_approved;
        $this->product_id = @$this->loan->loan_type;
    }

    public function prepareLoanLedgerEntry() {
        $entries = [];
        $refNumber = $this->setNextReferenceNumber();
        foreach ($this->loanTransactionConfig AS $config) {
            $entries[] = new Ledger(
                    [
                'amount' => $this->setLedgerAmount($config->amount_rule, $config->amount),
                'debit_account' => $config->debit_account,
                'credit_account' => $config->credit_account,
                'entry_type' => $config->product_type,
                'entry_reference_id' => $this->loan_id,
                'stage' => 'DISBURSEMENT',
                'description' => $config->transactionLabel->name,
                'member_account' => $this->loan->client->account_number,
                'entry_reference' => $refNumber,
                'due_date' => date('Y-m-d')
                    ]
            );
        }
        return $entries;
    }

    public function prepareLoanApplicationLedgerEntry() {
        $entries = [];
        $refNumber = $this->setNextReferenceNumber();
        foreach ($this->loanTransactionConfig AS $config) {
            $entries[] = new Ledger(
                    [
                'amount' => $this->setApplicationAmount($config->amount_rule, $config->amount),
                'debit_account' => $config->debit_account,
                'credit_account' => $config->credit_account,
                'entry_type' => $config->product_type,
                'entry_reference_id' => $this->loan_id,
                'stage' => 'APPLICATION',
                'description' => $config->transactionLabel->name,
                'member_account' => $this->loan->client->account_number,
                'ledger_status' => Ledger::STATUS_PAID,
                'entry_reference' => $refNumber,
                'due_date' => date('Y-m-d')
                    ]
            );
        }
        return $entries;
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
        foreach ($schedule AS $sch) {
            $scheduleEntry = $sch->jsonSerialize();
            //Principle
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
                'ledger_status' => Ledger::STATUS_NOTPAID,
                'due_date' => $scheduleEntry['date'],
                'next_date' => date("Y-m-d", strtotime($scheduleEntry['date'] . "+1 Day")),
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
                'ledger_status' => Ledger::STATUS_NOTPAID,
                'due_date' => $scheduleEntry['date'],
                'next_date' => date("Y-m-d", strtotime($scheduleEntry['date'] . "+1 Day")),
                    ]
            );
            $ref_num += 1;
        }
        return $entries;
    }

    public function prepareLoanPaymentSchedule() {
        //$loan
        $schedule = Loan::findOne($this->loan_id)->getPaymentSchedule(2);
        //Entries
        $entries = [];
        $nDays = 28*$this->loan->loan_period;
        foreach ($schedule AS $sch) {
            $scheduleEntry = $sch->jsonSerialize();
            //Principle
            $entries[] = new LoanPaymentSchedule(
                    [
                'loan_id' => $this->loan_id,
                'due_date' => $scheduleEntry['date'],
                'next_date' => date('Y-m-d',strtotime($this->loan->disbursment_date . '+ '.$nDays.'days'. "+1 Day")),
                'principal_amount' => round($scheduleEntry['principalDue'], 2),
                'interest_amount' => round($scheduleEntry['interestDue'], 2),
                'principal_paid' => 0,
                'interest_paid' => 0,
                'principal_dr_account' => 11110,
                'principal_cr_account' => 11300,
                'interest_dr_account' => 12210,
                'interest_cr_account' => 41110
                    ]
            );
        }
        return $entries;
    }

    /**
     * Prepare ledger records for loan payments
     */
    public function prepareLoanPayment($ledgers, $amount) {
        //$loan
        $schedule = Loan::findOne($this->loan_id)->getPaymentSchedule();
        $principalConfig = LedgerTransactionConfig::transactionByTag($this->product_id, 'principal');
        $interestConfig = LedgerTransactionConfig::transactionByTag($this->product_id, 'interest');
        //Entries
        $entries = [];
        $refNumber = $this->setNextReferenceNumber();
        $ref_num = 0;
        
        foreach ($schedule AS $sch) {
            $scheduleEntry = $sch->jsonSerialize();
            //Principle
            $entries[] = new Ledger(
                    [
                'amount' => $this->setLedgerAmount('FIXED', $scheduleEntry['principalRounded']),
                'debit_account' => $principalConfig[0]->debit_account,
                'credit_account' => $principalConfig[0]->credit_account,
                'entry_type' => $principalConfig[0]->product_type,
                'entry_reference_id' => $this->loan_id,
                'member_account' => $this->loan->client->account_number,
                'decription' => "Testing 123",
                'entry_reference' => $refNumber + $ref_num,
                'due_date' => $scheduleEntry['date']
                    ]
            );
            $ref_num += 1;
        }
        return $entries;
    }

    /**
     * Set the Ledger Amount
     */
    protected function setLedgerAmount($method, $amount = 0) {
        $ledger_amount = 0;
        switch ($this->tag) {
            case 'disbursement':
                $ledger_amount = $this->principal;
                break;

            default:
                switch ($method) {
                    case 'PERCENTAGE':
                        $ledger_amount = $this->principal * ($amount / 100);
                        break;

                    case 'FIXED';
                    default:
                        $ledger_amount = $amount;
                        break;
                }
                break;
        }

        return $ledger_amount;
    }

    /**
     * Set the Ledger Amount
     */
    protected function setApplicationAmount($method, $amount = 0) {
        $ledger_amount = 0;
        switch ($this->tag) {
            case 'application':
                $ledger_amount = $amount;
                break;
        }

        return $ledger_amount;
    }

    /**
     * Configuration
     */
    protected function getLoanTransactionConfig() {
        return RatedItem::transactionByTag($this->product_id);
    }

    /**
     * Configuration
     */
    protected function getInvestmentTransactionConfig() {
        return LedgerTransactionConfig::transactionTypeByTag($this->product_id, $this->tag);
    }

    /**
     * The next transaction Reference Number
     */
    public function setNextReferenceNumber() {
        $max = Ledger::find()->orderBy(['id' => SORT_DESC])->one();
        $lastref = is_object($max) ? ($max->entry_reference) : (10000000000000);
        return $lastref + 1;
    }

    /**
     * Prepare records for the (Ledger/Payments) Junction table
     */
    public static function setLedgerPayment($payment, $ledgers) {
        $payments = [];
        foreach ($ledgers AS $lg) {
            $payments[] = new Ledger(
                    [
                'amount' => $lg->amount,
                'debit_account' => $payment->debit_account,
                'credit_account' => $lg->debit_account,
                'entry_type' => $lg->entry_type,
                'entry_reference_id' => $lg->entry_reference_id,
                'member_account' => $lg->member_account,
                'entry_reference' => $lg->entry_reference,
                'due_date' => $lg->due_date,
                'description' => $lg->description . ' - settled',
                'payment_ref' => $payment->reference_no,
                'ledger_status' => Ledger::STATUS_PAID
                    ]
            );
        }

        return $payments;
    }

    public function setLedgerPayments($amount, $id, $dr = 0) {
        //$loan

        $principalConfig = LoanPaymentSchedule::findOne($this->loan_id);
        if ($id == 0) {
            $dr = 11110;
            $cr = 11300;
            $description = 'Principal';
        } else {
            $dr = 12210;
            $cr = 41110;
            $description = 'Interest';
        }


        //Entries
        $entries = [];
        //Principle
        $entries[] = new Ledger(
                [
            'amount' => $amount,
            'debit_account' => $dr,
            'credit_account' => $cr,
            'entry_type' => 'PAYMENT',
            'entry_reference_id' => $principalConfig->loan_id,
            'member_account' => $principalConfig->loan->client->account_number,
            'entry_reference' => $principalConfig->loan->client->account_number,
            'due_date' => $principalConfig->due_date,
            'description' => $description,
            'schedule_id' => $principalConfig->id,
            'ledger_status' => Ledger::STATUS_PAID
                ]
        );
        return $entries;
    }

    public function preparePaymentSchedule() {
        $entries = [];
        foreach ($this->loanTransactionConfig AS $config) {
            $entries[] = new Ledger(
                    [
                'amount' => $this->setLedgerAmount($config->amount_rule, $config->amount),
                'debit_account' => $config->debit_account,
                'credit_account' => $config->credit_account,
                'entry_type' => $config->product_type,
                'entry_reference_id' => $this->loan_id,
                'description' => $config->transactionLabel->name,
                'member_account' => $this->loan->client->account_number,
                'due_date' => date('Y-m-d')
                    ]
            );
        }
        return $entries;
    }

    public function prepareInvestmentEntries() {
        $principalConfig = LedgerTransactionConfig::transactionTypeByTag($this->product_id, 'investment');
        $interestConfig = LedgerTransactionConfig::transactionTypeByTag($this->product_id, 'interest');
        //Entries
        $entries = [];
        $refNumber = $this->setNextReferenceNumber();
        $ref_num = 1;
        //Amount to invest
        $entries[] = new Ledger(
                [
            'amount' => $this->investment->amount_to_invest,
            'debit_account' => $principalConfig[0]->debit_account,
            'credit_account' => $principalConfig[0]->credit_account,
            'entry_type' => $principalConfig[0]->product_type,
            'entry_reference_id' => $this->investment->id,
            'member_account' => $this->investment->investor->reference_number,
            'description' => $principalConfig[0]->transactionLabel->name,
            'entry_reference' => $refNumber + $ref_num,
            'due_date' => @$scheduleEntry['date']
                ]
        );

        //Interest
        $entries[] = new Ledger(
                [
            'amount' => $this->investment->amount_to_invest * $this->investment->interest_rate * 0.01,
            'debit_account' => $interestConfig[0]->debit_account,
            'credit_account' => $interestConfig[0]->credit_account,
            'entry_type' => $interestConfig[0]->product_type,
            'entry_reference_id' => $this->investment->id,
            'member_account' => $this->investment->investor->reference_number,
            'description' => @$interestConfig[0]->transactionLabel->name,
            'entry_reference' => $refNumber + $ref_num,
            'due_date' => @$scheduleEntry['date']
                ]
        );
        $ref_num += 1;
        return $entries;
    }

    /**
     * Set the Ledger Amount
     */
    protected function setInterestAmount($method, $amount = 0) {
        $ledger_amount = 0;
        switch ($method) {
            case 'WEEKLY':
                $ledger_amount = $this->principal * ($amount / 100);
                break;

            case 'MONTHLY':
                $ledger_amount = $this->principal * ($amount / 100);
                break;
            case 'ANNUALLY':
                $ledger_amount = $this->principal * ($amount / 100);
                break;
            default:
                $ledger_amount = $amount;
                break;
        }

        return $ledger_amount;
    }

    public function prepareRatedItem() {
        $schedule = RatedItem::find()->all();
        $entries = [];
        foreach ($schedule AS $sch) {
            //Principle
            $entries[] = new Score(
                    [
                'client_id' => $this->loan->client->id,
                'loan_id' => $this->loan_id,
                'rate_item_id' => $sch->id,
                    ]
            );
        }
        return $entries;
    }

    public function prepareBorrowerRequirements() {
        $schedule = BorrowRequirements::find()->all();
        $entries = [];
        foreach ($schedule AS $sch) {
            //Principle
            $entries[] = new BorrowerCheckList(
                    [
                'client_id' => $this->loan->client->id,
                'loan_id' => $this->loan_id,
                'requirement_id' => $sch->id,
                'category' => $sch->category,
                    ]
            );
        }
        return $entries;
    }

}
