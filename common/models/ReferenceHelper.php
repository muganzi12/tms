<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use common\models\client\ChartOfAccounts;
use common\models\loan\Ledger;
use common\models\loan\LedgerPayment;
use common\models\client\Client;
use common\models\client\Investor;
use common\models\client\Investment;
use common\models\client\Loan;

/**
 * Reference Numbers for different records in the system
 */
class ReferenceHelper extends Model {

    /**
     * The  Reference Number for a ledger Record
     */
    public static function getLedgerReferenceNumber() {
        $max = Ledger::find()->orderBy(['id' => SORT_DESC])->one();
        $lastref = is_object($max) ? ($max->entry_reference) : (10000000000000);
        return $lastref + 1;
    }

    /**
     * Next Reference Number for a payment Record
     */
    public static function getPaymentReferenceNumber() {
        $max = LedgerPayment::find()->orderBy(['id' => SORT_DESC])->one();
        $lastref = is_object($max) ? ($max->reference_no) : (20000000000000);
        return $lastref + 1;
    }

    /**
     * Next  File for a client Record
     */
    public static function getClientReferenceNumber($scenario) {
        $max = Client::find()->where(['person_scenario' => $scenario])->orderBy(['id' => SORT_DESC])->one();
        $maxim = Investor::find()->orderBy(['id' => SORT_DESC])->one();
        $investment = Investment::find()->orderBy(['id' => SORT_DESC])->one();
        $lastref = 0;
        switch ($scenario) {
            case 'INVESTOR':
                $lastref = is_object($maxim) ? ($maxim->reference_number) : (70100000000000);
                break;

            case 'INVESTMENT':
                $lastref = is_object($investment) ? ($investment->reference_number) : (70200000000000);
                break;

            case 'CLIENT':
                $lastref = is_object($max) ? ($max->account_number) : (70900000000000);
                break;

            case 'NEXTOFKIN':
                $lastref = is_object($max) ? ($max->account_number) : (80900000000000);
                break;
        }
        //Next Ref Number
        return ($lastref == 0) ? (0) : ($lastref + 1);
    }

    /**
     * Next Reference Number for a Loan Application Record
     */
    public static function getLoanReferenceNumber() {
        $max = Loan::find()->orderBy(['id' => SORT_DESC])->one();
        $lastref = 0;
        $lastref = is_object($max) ? ($max->reference_number) : (80900000000000);
        //Next Ref Number
        return ($lastref == 0) ? (0) : ($lastref + 1);
    }
    
      /**
     * 
     * Total Principal Paid
     */

     public static function getTotalPrincipalPaid($id) {
        $query = new Query();
        $query->select("SUM(amount) AS principal_paid");
        $query->from('ledger');
        //$query->where("credit_account = '11300'");
        $query->andWhere(['entry_reference_id' => $id]);
        $query->andWhere(['ledger_status' => 42]);
        return $query->one();
    }
    
    
    
       /**
     * 
     * Total Principal Paid
     */

     public static function getTotaLoan($ledger) {
        $query = new Query();
        $query->select("SUM(amount_approved) AS principal_paid");
        $query->from('loan');
        $query->where(['client_id' => $ledger]);
        return $query->one();
    }
    
    
      public static function getTotalBalance($ledger) {
        $payledgers = explode(",", $ledger);
        $query = new Query();
        $query->select("SUM(amount) AS principal_paid");
        $query->from('ledger');
        $query->where("credit_account = '11300'");
        $query->andWhere(['entry_reference_id' => $payledgers]);
        $query->andWhere(['ledger_status' => 42]);
        return $query->one();
    }

}
