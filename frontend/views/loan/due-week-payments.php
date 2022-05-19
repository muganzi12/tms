<?php

use yii\helpers\Html;
use yii\grid\GridView;
use nullref\datatable\DataTable;
use common\models\Reports;

/* @var $this yii\web\View */
/* @var $searchModel common\models\report\LoanInterestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments Due this Week';
$this->params['breadcrumbs'][] = $this->title;
$report = new Reports();
$payment = $report->getPaymentsDueThisWeek();
?>
<style>

   
    input[type="search"] {
        width:500px;
        border:1px solid green;
        padding:3px;
    }
</style>
<div class="loan-interest-index">
<?php
    echo DataTable::widget([
           'data' => $dataProvider->getModels(),
        'tableOptions' => ['class' => 'table table-striped', 'style' => 'width: 100%'],
        'id' => 'index',
        'columns' => [
            
            ['attribute' => 'profile', 'title' => 'Passport'],
            ['attribute' => 'member_account', 'title' => 'Account Number'],
            ['attribute' => 'fullNames', 'title' => 'Client'],
            ['attribute' => 'description', 'title' => 'Description'],
             ['attribute' => 'due_date', 'title' => 'Due Date'],
            ['attribute' => 'transactionAmount', 'title' => 'Amount'],
            ['attribute' => 'entry_period', 'title' => 'Loan Period'],
            ['attribute' => 'statusButton', 'title' => 'Status'],
             ['attribute' => 'paymentButton', 'title' => 'Option']
        ],
    ]);
    ?>

</div>

