<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = "Proof of Payment";
//Page descrition
$this->params['page_description'] = 'Chart of Accounts';
//Pass LoanID to the layout 
$this->params['schedule_id'] = $scheduleId;
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


        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'type_of_collateral',
                [
                    'attribute' => 'reference_no',
                    'value' => function($data) {
                        return $data->reference_no;
                    },
                    'format' => 'raw'
                ],

                [
                    'attribute' => 'amount_paid',
                    'value' => function($data) {
                        return number_format($data->amount_paid);
                    },
                    'format' => 'raw'
                ],
                'payment_date',
                // 'debit_account',
                 'paid_by',
                  'description',
                [
                    'attribute' => 'proof_attachment',
                    'label' => 'Proof of Payment',
                    'format' => 'raw',
                    'value' => function ($data) {
                        $url = Yii::getAlias('@web/html/payments/') . $data->proof_attachment;
                        return Html::img($url, ['alt' => '', 'width' => '200', 'height' => '100']);
                    },
                    'headerOptions' => ['style' => 'width:200px;color:#ffffff;'],
                    'format' => 'raw'
                ],
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>

</div>
