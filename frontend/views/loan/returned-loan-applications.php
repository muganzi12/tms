<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use nullref\datatable\DataTable;
/* @var $this yii\web\View */
/* @var $searchModel common\models\client\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Returned Loan Applications for works';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>

   
    input[type="search"] {
        width:500px;
        border:1px solid green;
        padding:3px;
    }
</style>
<div class="loan-index">



</div>
 <?php
    echo DataTable::widget([
        'data' => $dataProvider->getModels(),
        'tableOptions' => ['class' => 'table table-striped', 'style' => 'width: 100%'],
        'id' => 'index',
        'columns' => [
            ['attribute' => 'id', 'title' => 'S/N'],
            ['attribute' => 'referenceNumber', 'title' => 'Reference Number'],
            ['attribute' => 'fullNames', 'title' => 'Client'],
            ['attribute' => 'amountApplied', 'title' => 'Amount Applied For'],
            ['attribute' => 'loan_period', 'title' => 'Loan Period'],
            ['attribute' => 'interest_rate', 'title' => 'Interest Rate',],
            ['attribute' => 'statusButton', 'title' => 'Status']
        ],
    ]);
    ?>