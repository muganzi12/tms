<?php

use yii\helpers\Html;
use yii\grid\GridView;
use nullref\datatable\DataTable;
use common\models\Reports;

/* @var $this yii\web\View */
/* @var $searchModel common\models\report\LoanInterestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$report = new Reports();
$over_due = $report->getOverDuePayments();
$total = $report->getSuspendedAmount();
$this->title = 'DUE AMOUNT: '.number_format($total['loan_suspended_amount']);
$this->params['breadcrumbs'][] = $this->title;

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
            ['attribute' => 'transactionAmount', 'title' => 'Due Amount'],
            ['attribute' => 'entry_period', 'title' => 'Loan Period'],
            ['attribute' => 'statusButton', 'title' => 'Status']
        ],
    ]);
    ?>
</div>
<pre>
    
<?php print_r($total);?>
</pre>

