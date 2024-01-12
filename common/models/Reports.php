<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\Query;

/**
 * Reports for the eComplaint
 */
class Reports extends Model
{

    public static function getUser()
    {
        return Yii::$app->db->createCommand("SELECT * ,count(*) AS total_number FROM user GROUP BY id")->queryAll();
    }

    public function requetsByInstitution()
    {
        return Yii::$app->db->createCommand("SELECT(SELECT  count(*) FROM user WHERE status=1) AS Pending,
            (SELECT count(*) FROM user WHERE status=1) AS Approved, (SELECT count(*) FROM user WHERE status=2) AS Rejected,
            (SELECT count(*) FROM user WHERE status=1) AS Offset, (SELECT count(*) FROM user WHERE status=1) AS Merged,
            (SELECT count(*) FROM user  WHERE status=2) AS Disbursed")->queryAll();
    }

    /**
     * Total Loan Balance
     */
    public static function getInterestNotPaid()
    {
        $query = new Query();
        return $query->select("(SELECT(SELECT sum(interest_amount) from loan_payment_schedule WHERE interest_dr_account=12210)-(SELECT sum(interest_paid) from loan_payment_schedule WHERE interest_cr_account=41110)) AS InterestNotPaid")
            ->all();
    }

    /**
     * Total Loan Balance
     */
    public static function getPrincipalNotPaid()
    {
        $query = new Query();
        return $query->select("(SELECT(SELECT sum(principal_amount) from loan_payment_schedule WHERE principal_dr_account=11110)-(SELECT sum(principal_paid) from loan_payment_schedule WHERE principal_cr_account=11300)) AS PrincipalNotPaid")
            ->all();
    }

    public static function getLedger($id)
    {
        $query = new Query();
        $query->select("*");
        $query->from('ledger');
        $query->where(['schedule_id' => $id]);
        return $query->all();
    }
}
