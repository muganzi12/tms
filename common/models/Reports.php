<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use common\models\client\ChartOfAccounts;

/**
 * Reports for the eComplaint
 */
class Reports extends Model {

 

    public static function getApprovedLoanApplications() {
        $query = new Query();
        return $query->select(" (SELECT count(*) from loan where status =20) AS approved_loans")
                        ->one();
    }

    public static function getPendingLoanApplications() {
        $query = new Query();
        return $query->select(" (SELECT count(*) from loan) AS pending_loans")
                        ->one();
    }

    /**
     * Number of clients for a given Scenario and Registration Status
     */
    public function getClientCount($status, $scenario = "CLIENT") {
        $query = new Query();
        $query->select("count(*) AS numberof");
        $query->from('client');
        $query->where("person_scenario='{$scenario}'");
        $query->andWhere(['status' => $status]);
        $number = $query->one();
        return $number['numberof'];
    }

    public static function getPendingClients() {
        $query = new Query();
        $query->select("count(*) AS pending_clients");
        $query->from('client');
        $query->where("person_scenario='CLIENT'");
        $query->andWhere(['status' => 19]);
        return $query->one();
    }

    public static function getApprovedClients() {
        $query = new Query();
        $query->select("count(*) AS approved_clients");
        $query->from('client');
        $query->where("person_scenario='CLIENT'");
        $query->andWhere(['status' => 20]);
        return $query->one();
    }

    public static function getRejectedLoanApplications() {
        $query = new Query();
        return $query->select(" (SELECT count(*) from loan where status =36) AS rejected_loans")
                        ->one();
    }

    public static function getLoanApplications() {
        $query = new Query();
        return $query->select(" (SELECT count(*) from loan where status =36) AS rejected_loans")
                        ->one();
    }

    public static function getDisbursedLoan() {
        $query = new Query();
        return $query->select(" (SELECT count(*) from loan where status =41) AS released_loans")
                        ->one();
    }

    public static function getTotalLoans() {
        $query = new Query();
        return $query->select("(SELECT count(*) from loan) AS total_loans")
                        ->one();
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
     * Payments Due this week
     */
    public static function getPaymentsDueThisWeek() {
        $sql = "SELECT *
                FROM ledger
                WHERE (WEEKOFYEAR(due_date)=WEEKOFYEAR(CURDATE()) AND ledger_status=42) ORDER BY created_at ASC";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
    
      /**
     * Payments Due this week
     */
    public static function getPaymentsDueToday() {
        $sql = "SELECT *
                FROM ledger
                WHERE (DAYOFYEAR(due_date)=DAYOFYEAR(CURDATE()) AND ledger_status=42) ORDER BY created_at ASC";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * Paid this week
     */
    public static function getPaidThisWeek() {
        $sql = "SELECT *
                FROM ledger
                WHERE (WEEKOFYEAR(due_date)=WEEKOFYEAR(CURDATE()) AND ledger_status=43) ORDER BY created_at ASC";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * Payments Due this week
     */
    public static function getPaymentsDueThisMonth() {
        $sql = "SELECT *
                FROM ledger
                WHERE (MONTH(due_date) = MONTH(CURRENT_DATE()) AND YEAR(due_date) = YEAR(CURRENT_DATE()) AND ledger_status=42) ORDER BY created_at ASC";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * Paid this Month
     */
    public static function getPaidThisMonth() {
        $sql = "SELECT *
                FROM ledger
                WHERE (MONTH(due_date) = MONTH(CURRENT_DATE()) AND YEAR(due_date) = YEAR(CURRENT_DATE()) AND ledger_status=43) ORDER BY created_at ASC";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * 
     * Total Amount Disbursed
     */
    public static function getTotalLoanAmount() {
        $query = new Query();
        return $query->select("(SELECT SUM(amount_approved) FROM loan) AS total_loan_amount")
                        ->one();
    }

    /**
     * 
     * Total Amount Interest
     */
    public static function getTotalInterestAmount() {
        $query = new Query();
        return $query->select("(SELECT SUM(interest_amount) FROM loan_payment_schedule where interest_dr_account = 12210) AS total_interest_amount")
                        ->one();
    }

    /**
     * 
     * Total Principal
     */
    public static function getTotalPrincipalAmount() {
        $query = new Query();
        return $query->select("(SELECT SUM(principal_amount) FROM  loan_payment_schedule where principal_dr_account = 11110) AS total_principal_amount")
                        ->one();
    }

    /**
     * 
     * Total Principal
     */
    public static function getTotalPrincipalAmountPaid() {
        $query = new Query();
        return $query->select("(SELECT SUM(principal_paid) FROM loan_payment_schedule where principal_dr_account = 11110) AS principal_amount_paid")
                        ->one();
    }

    /**
     * Total Loan Balance
     */
    public static function getTotalLoanBalance() {
        $query = new Query();
        return $query->select("(SELECT(SELECT sum(amount) from ledger WHERE(debit_account=11110 AND ledger_status=42))+(SELECT sum(amount) from ledger WHERE(debit_account=12210 AND ledger_status=42))) AS total_loan_balance")
                        ->one();
    }
    
       public static function getClient() {
        $sql = "SELECT *
                FROM client
                WHERE(person_scenario='CLIENT') ORDER BY created_at ASC";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    
    
    
     /**
     * Ledger Report
     */
    public static function getLedgerReport() {
        $sql = "SELECT due_date,member_account,   CASE description WHEN 'NULL' THEN NULL ELSE COALESCE(description, 'Total') END AS description,SUM(amount) AS amount
       FROM ledger
       WHERE(debit_account='11110' OR debit_account='12210') 
       GROUP BY due_date,member_account,description WITH ROLLUP";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
    
  
    public static function getLoanAmountPaid() {
        $query = new Query();
        $query->select("SUM(interest_paid) AS loan_amount_paid");
        $query->from('loan_payment_schedule');
        return $query->one();
    }
    
    
        public static function getSuspendedAmount() {
        $query = new Query();
        $query->select("SUM(amount) AS loan_suspended_amount");
        $query->from('general_ledger');
        $query->where("account = '12210'");
        $query->where("entry_type = 'LOAN'");
        $query->andWhere(['ledger_status' => 85]);
        return $query->one();
    }

      public static function getPenalizedAmount() {
        $query = new Query();
        $query->select("SUM(amount) AS loan_penalty_amount");
        $query->from('general_ledger');
        $query->where("account = '12210'");
        $query->where("entry_type = 'LOAN'");
        $query->andWhere(['ledger_status' => 25]);
        return $query->one();
    }
     public static function getLoanAmountNotPaid() {
        $query = new Query();
        $query->select("SUM(amount) AS loan_interest_not_paid");
        $query->from('general_ledger');
        $query->where("account = '12210'");
        $query->where("entry_type = 'LOAN'");
        $query->andWhere(['ledger_status' => 42]);
        return $query->one();
    }

    /**
     * List of All Chat of Accounts
     */
    public static function getChartOfAccounts($include_header = true) {
        $qry = ChartOfAccounts::find();
        if (!$include_header) {
            $qry->where(['>', 'parent_id', 0]);
        }
        $qry->orderBy(['gl_code' => SORT_ASC]);
        return $qry->all();
    }

    /**
     * Number of clients by gender
     * @return type
     */
    public function getClientByGender() {
        return Yii::$app->db->createCommand("SELECT inst.name, count(*) AS total_number
                    FROM client req JOIN master_data inst ON req.gender=inst.id 
                    GROUP BY inst.name")->queryAll();
    }
    
    
       /**
     * Number of clients by gender
     * @return type
     */
    public static function getLedgerEntries() {
        return Yii::$app->db->createCommand("SELECT * FROM ledger")->queryAll();
    }
      
       /**
     * Over due Payments
     */
    
       public static function getOverTotalAmount() {
        $query = new Query();
        $query->select("SUM(amount) AS overdue_payments");
        $query->from('overdue_payments');
        $query->andWhere(['ledger_status' => 42]);
        return $query->one();
    }
    
    
          
       /**
     * Over due Principal Payments
     */
    
       public static function getDuePrincipalAmount() {
        $query = new Query();
        $query->select("SUM(amount) AS due_payments");
        $query->from('ledger');
         $query->where("debit_account = '11110'");
        $query->andWhere(['ledger_status' => 42]);
        return $query->one();
    }
    
              
       /**
     * Paid Principal Payments
     */
    
       public static function getPaidPrincipalAmount() {
        $query = new Query();
        $query->select("SUM(amount) AS due_payments");
        $query->from('ledger');
        $query->where("debit_account = '11110'");
        $query->andWhere("entry_type = 'LOAN'");
        $query->andWhere(['ledger_status' => 43]);
        return $query->one();
    }
    
              
       /**
     * Due Interest Payments
     */
    
       public static function getDueInterestAmount() {
        $query = new Query();
        $query->select("SUM(amount) AS due_payments");
        $query->from('ledger');
         $query->where("debit_account = '12210'");
        $query->andWhere(['ledger_status' => 42]);
        return $query->one();
    }
    
      
              
       /**
     * Due Interest Payments
     */
    
       public static function getPaidInterestAmount() {
        $query = new Query();
        $query->select("SUM(amount) AS due_payments");
        $query->from('ledger');
         $query->where("debit_account = '12210'");
         $query->andWhere("entry_type = 'LOAN'");
        $query->andWhere(['ledger_status' => 43]);
        return $query->one();
    }
    
        public function getPricipalAmount() {
        return Yii::$app->db->createCommand("SELECT inst.name, sum(amount) AS total_request
                    FROM ledger  req JOIN master_data inst ON req.ledger_status=inst.id where debit_account=11110
                    GROUP BY inst.name")->queryAll();
    }
 
    
    public function getPricipalAmount2() {
        return Yii::$app->db->createCommand("SELECT(SELECT SUM(principal_amount) FROM loan_payment_schedule WHERE principal_dr_account=11110
            ) AS AmountDisbursed,(SELECT SUM(principal_amount) FROM loan_payment_schedule WHERE principal_dr_account=11110) AS ExpextedPrincipal,
            (SELECT SUM(principal_amount) FROM loan_payment_schedule WHERE principal_dr_account=11110) AS PrincipalNotPaid,
            (SELECT SUM(principal_paid) FROM loan_payment_schedule  WHERE principal_cr_account=11300) AS PrincipalPaid")->queryAll();
    }
    
      public function getInterestAmount() {
        return Yii::$app->db->createCommand("SELECT(
            SELECT SUM(interest_amount) FROM loan_payment_schedule WHERE interest_dr_account=12210) AS ExpextedInterest,
            (SELECT SUM(interest_paid) FROM loan_payment_schedule WHERE interest_cr_account=41110) AS InterestNotPaid,
            (SELECT SUM(amount) FROM ledger WHERE credit_account=41110 AND ledger_status=85) AS InterestSuspended,
            (SELECT SUM(interest_paid) FROM loan_payment_schedule  WHERE interest_cr_account=41110) AS InterestPaid")->queryAll();
    }
    

    
       public function requetsByInstitution() {
        return Yii::$app->db->createCommand("SELECT(SELECT  count(*) FROM loan WHERE status=19) AS Pending,
            (SELECT count(*) FROM loan WHERE status=20) AS Approved, (SELECT count(*) FROM loan WHERE status=36) AS Rejected,
            (SELECT count(*) FROM loan WHERE status=73) AS Offset, (SELECT count(*) FROM loan WHERE status=74) AS Merged,
            (SELECT count(*) FROM loan  WHERE status=41) AS Disbursed")->queryAll();
    }
    
    
       /**
     * Total Loan Balance
     */
    public static function getInterestNotPaid() {
        $query = new Query();
        return $query->select("(SELECT(SELECT sum(interest_amount) from loan_payment_schedule WHERE interest_dr_account=12210)-(SELECT sum(interest_paid) from loan_payment_schedule WHERE interest_cr_account=41110)) AS InterestNotPaid")
                        ->all();
    }
    
           /**
     * Total Loan Balance
     */
    public static function getPrincipalNotPaid() {
        $query = new Query();
        return $query->select("(SELECT(SELECT sum(principal_amount) from loan_payment_schedule WHERE principal_dr_account=11110)-(SELECT sum(principal_paid) from loan_payment_schedule WHERE principal_cr_account=11300)) AS PrincipalNotPaid")
                        ->all();
    }
    
    
 

      public static function getLedger($id) {
        $query = new Query();
        $query->select("*");
        $query->from('ledger');
        $query->where(['schedule_id' => $id]);
        return $query->all();
    }
}
