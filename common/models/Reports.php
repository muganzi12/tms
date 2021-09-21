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

   /**
    * Number of clients for a given Scenario and Registration Status
    */ 
public function getClientCount($status,$scenario="CLIENT"){
    $query = new Query();
    $query->select("count(*) AS numberof");
    $query->from('client');
    $query->where("person_scenario='{$scenario}'");
    $query->andWhere(['status'=>$status]);
    $number = $query->one();
    return $number['numberof'];
}
    
public static function getPendingClients() {
        $query = new Query();
        $query->select("count(*) AS pending_clients");
        $query->from('client');
        $query->where("person_scenario='CLIENT'");
        $query->andWhere(['status'=>19]);
        return $query->one();
    }
     public static function getApprovedClients() {
        $query = new Query();
        $query->select("count(*) AS approved_clients");
        $query->from('client');
        $query->where("person_scenario='CLIENT'");
        $query->andWhere(['status'=>20]);
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

    /**
     * List of All Chat of Accounts
     */
    public static function getChartOfAccounts($include_header=true){
        $qry = ChartOfAccounts::find();
        if(!$include_header){
            $qry->where(['>','parent_id',0]);
        }
        $qry->orderBy(['gl_code'=>SORT_ASC]);
        return $qry->all();
    }

}
