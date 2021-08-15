<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\Query;

/**
 * Reports for the eComplaint
 */
class Reports extends Model {

    public function requetsByInstitution() {
        return Yii::$app->db->createCommand("SELECT inst.name, count(*) AS total_request
                    FROM loan req JOIN master_data inst ON req.status=inst.id 
                    GROUP BY inst.name")->queryAll();
    }

    public static function getApprovedLoanApplications() {
        $query = new Query();
        return $query->select(" (SELECT count(*) from loan where status =20) AS approved_loans")
                        ->one();
    }

    public static function getPendingLoanApplications() {
        $query = new Query();
        return $query->select(" (SELECT count(*) from loan where status =19) AS pending_loans")
                        ->one();
    }

    public static function getPendingClients() {
        $query = new Query();
        return $query->select(" (SELECT count(*) from client where status =19) AS pending_clients")
                        ->one();
    }
     public static function getApprovedClients() {
        $query = new Query();
        return $query->select(" (SELECT count(*) from loan where status =20) AS approved_clients")
                        ->one();
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

}
