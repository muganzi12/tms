<?php

namespace common\models\loan;

use Yii;
use yii\base\Model;
use yii\db\Query;
use common\models\client\ChartOfAccounts;
use common\models\client\Loan;
use common\models\client\Investment;

/**
 * Helper class for the General Ledger
 */
class LedgerInvestmentHelper extends Model {

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
        $this->setInvestmentAttributes();
    }

    protected function setInvestmentAttributes() {
        $this->investment = Investment::findOne($this->investment_id);
        $this->principal = @$this->investment->amount_to_invest;
        $this->product_id = @$this->investment->loan_type;
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
            'amount' => $this->investment->amount_to_invest *$this->investment->interest_rate *0.01,
            'debit_account' => $interestConfig[0]->debit_account,
            'credit_account' => $interestConfig[0]->credit_account,
            'entry_type' => $interestConfig[0]->product_type,
            'entry_reference_id' => $this->investment->id,
            'member_account' => $this->investment->investor->reference_number,
            'description' => @$interestConfig[0]->transactionLabel->name,
            'entry_reference' => $refNumber + $ref_num,
            'interest_status' => Ledger::STATUS_NOTPAID,
            'due_date' => @$scheduleEntry['date']
                ]
        );
        $ref_num += 1;
        return $entries;
    }

 

}
