<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\client\ClientMasterData;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use nullref\datatable\DataTable;
/* @var $this yii\web\View */
/* @var $searchModel common\models\client\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loan Applications';
$this->params['breadcrumbs'][] = $this->title;
//Pass CLientID to the layout 
$this->params['client_id'] = $model->id;
?>
<p>
    <?= Html::button('Merge Loans', ['class' => 'pull-right btn btn-primary','onclick'=>'makePayment()']) ?>
</p>
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
<h2 style="border-bottom:2px solid 3px;color:#069;">Loan Applications</h2>
    <div class="profile-section" style="margin-top:20px;">
    
        <div class="col-lg-12" style="padding:0px;">



      </div>
   
    </div>

 <?php
    echo DataTable::widget([
        'data' => $model->loanEntries,
        'tableOptions' => ['class' => 'table table-striped', 'style' => 'width: 100%'],
        'id' => 'loan-applications',
        'columns' => [
            ['attribute' => 'checkboxField', 'title' => ''],
            ['attribute' => 'referenceNumber', 'title' => 'Reference Number'],
            ['attribute' => 'amountApplied', 'title' => 'Amount Applied For'],
            ['attribute' => 'amountApproved', 'title' => 'Amount Approved'],
             ['attribute' => 'amountBalance', 'title' => 'Balance'],
            ['attribute' => 'loan_period', 'title' => 'Loan Period'],
            ['attribute' => 'interest_rate', 'title' => 'Interest Rate',],
            ['attribute' => 'statusButton', 'title' => 'Status']
        ],
    ]);
    ?>


    <script>
    function getSelectedRows() {
        return $('input:checked').map(function () {
            return this.value;
        }).get();
    }
    
    //Selected Records
    function getSelectedRecords(_keys) {
        let selected_values = [];
        for (i = 0; i < _keys.length; i++) {
            var _value = $('#row' + _keys[i]).val();
            selected_values.push(_value);
        }
        return selected_values;
    }

    /**
    * Make payment
    */
    function makePayment() {
        var keys = getSelectedRows();
        if (keys.length > 0) {
            var id = getSelectedRecords(keys);
            };
            //Remove null values
            var filteredKeys = id.filter(function (el) {
                return el != null;
            });
           return  location.href="<?= Url::to(['loan/merge','id'=>$model->id]); ?>&ledger="+filteredKeys;
    }
    </script>