<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use nullref\datatable\DataTable;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\InvestorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Investors';
$this->params['breadcrumbs'][] = $this->title;
//Pass InvestmentID to the layout 
$this->params['investor_id'] = $investorId;
?>
<div class="investor-index">

<style>
    .profile-section{}
    .profile-section h5{
        border-bottom: 3px solid #3C8BE5;
        color:#135095;
        font-weight: bold !important;
    }
     input[type="search"] {
        width:400px;
        border:1px solid green;
        padding:3px;
    }
</style>
<section class="sheet padding-10mm" style="padding:0 7px 0 7px;">
<h2 style="border-bottom:2px solid 3px;color:#069;">Investments</h2>
    <div class="profile-section" style="margin-top:20px;">
    
        <div class="col-lg-12" style="padding:0px;">



      </div>
   
    </div>

 <?php
    echo DataTable::widget([
        'data' => $dataProvider->getModels(),
        'tableOptions' => ['class' => 'table table-striped', 'style' => 'width: 100%'],
        'id' => 'index',
        'columns' => [
            ['attribute' => 'id', 'title' => 'S/N'],
            ['attribute' => 'referenceNumber', 'title' => 'Reference Number'],
            ['attribute' => 'investmentAmount', 'title' => 'Amount'],
            ['attribute' => 'payment_frequency', 'title' => 'Frequency'],
            ['attribute' => 'investment_duration', 'title' => 'Duration'],
            ['attribute' => 'interest_rate', 'title' => 'Interest Rate',],
            ['attribute' => 'statusButton', 'title' => 'Status']
        ],
    ]);
    ?>
</div>