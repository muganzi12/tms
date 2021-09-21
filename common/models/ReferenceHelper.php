<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use common\models\client\ChartOfAccounts;
use common\models\loan\Ledger;
use common\models\loan\LedgerPayment;
use common\models\client\Client;

/**
 * Reference Numbers for different records in the system
 */
class ReferenceHelper extends Model {

        /**
        * The  Reference Number for a ledger Record
        */
    public static function getLedgerReferenceNumber(){
        $max = Ledger::find()->orderBy(['id'=>SORT_DESC])->one();
        $lastref = is_object($max)?($max->entry_reference):(10000000000000);
        return $lastref+1;
    }

    /**
     * Next Reference Number for a payment Record
     */
    public static function getPaymentReferenceNumber(){
        $max = LedgerPayment::find()->orderBy(['id'=>SORT_DESC])->one();
        $lastref = is_object($max)?($max->reference_no):(20000000000000);
        return $lastref+1;
    }

    /**
     * Next  File for a client Record
     */
    public static function getClientReferenceNumber($scenario){
        $max = Client::find()->where(['person_scenario'=>$scenario])->orderBy(['id'=>SORT_DESC])->one();
        $lastref=0;
        switch($scenario){
            case 'INVESTOR':
                $lastref = is_object($max)?($max->account_number):(70100000000000);
                break;
                
                case 'CLIENT':
                    $lastref = is_object($max)?($max->account_number):(70900000000000);
                break;
        }
        //Next Ref Number
        return ($lastref==0)?(0):($lastref+1);
    }
}