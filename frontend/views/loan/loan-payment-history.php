<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use nullref\datatable\DataTable;
$this->title = "Payment History";
//Page descrition
$this->params['page_description'] = 'Loan Gurantors';
//Pass LoanID to the layout 
$this->params['loan_id'] = $model->id;
?>
<style>
    .profile-section{}
    .profile-section h5{
        border-bottom: 3px solid #3C8BE5;
        color:#135095;
        font-weight: bold !important;
    }
</style>
<section class="sheet padding-10mm" style="padding:0 7px 0 7px;">

      <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-12" style="padding:0px;">
    <?php
    echo DataTable::widget([
        'data' => $model->paymentEntries,
        'tableOptions' => ['class' => 'table table-striped', 'style' => 'width: 100%'],
        'id' => 'payment_history',
        'columns' => [
            ['attribute' => 'transactionDate', 'title' => 'Date Paid'],
            ['attribute' => 'transactionAmount', 'title' => 'Amount'],
            ['attribute' => 'description', 'title' => 'Description',],
            ['attribute' => 'paidBy', 'title' => 'Paid By',]
        ],
    ]);
    ?>
    </div>

</div>
