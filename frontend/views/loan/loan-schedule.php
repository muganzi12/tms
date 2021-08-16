<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\client\MasterData;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use cog\LoanPaymentsCalculator;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loan Applications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">
    <?php
//Read values passed from HTML-form. 
    $capital = 2000000;
    $interest = 0.02;
    $year = 2;
    $instalment = 12;

//Print passed values to page. 
    print "Capital $capital<br>";
    print "Interest $interest<br>";
    print "Instalment $instalment<br>";
    print "Years $year<br>";

//Calculate time in months. 
    $months = $year * 12;

//Check out which is the instalment. 
    if (strcmp($instalment, "Fixed") == 0) {
//Fixed amortization schedule 
//Calculate fixed payment for month. 
        $fixedPayment = $capital / $months;
        $interestRateForMonth = $interest / 12;

//Calculate interest for every month. 
        for ($i = 0; $i < $months; $i++) {
//Interest for the month. 
            $interestForMonth = $capital / 100 * $interestRateForMonth;
//Diminish capital after calculating interest. 
            $capital = $capital - $fixedPayment;
//Payment for month is fixed pay + interest. 
            $paymentForMonth = $fixedPayment + $interestForMonth;
//Print out payment for this month. Output is formatted (payment has two digits) 
            $month = $i + 1;
            printf("$month payment is %.2f<br>", $paymentForMonth);
        }
    }
//Annuity 
    else {
//Calculate montly pay. 
        $interest = $interest / 100;
        $result = $interest / 12 * pow(1 + $interest / 12, $months) / (pow(1 + $interest / 12, $months) - 1) * $capital;
        //printf("Monthly pay is %.2f", $result);
    }
    ?> 
</div>

<pre>
    <?php print_r($result); ?>
</pre>