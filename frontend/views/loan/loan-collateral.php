<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = "Chart of Accounts";
//Page descrition
$this->params['page_description'] = 'Chart of Accounts';
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
    <?= $this->render('details/page-header_loan', ['model' => $loan, 'active_menu' => 'collateral']); ?>
      <?= $this->render('registration/reg-steps-top-nav',['model'=>$loan,'active'=>'collateral']); ?>
      <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-10" style="padding:0px;">


        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'type_of_collateral',
                [
                    'attribute' => 'type_of_collateral',
                    'value' => function($data) {
                        return $data->collateralType->name;
                    },
                    'format' => 'raw'
                ],
                'description',
                [
                    'attribute' => 'estimated_price',
                    'value' => function($data) {
                        return number_format($data->estimated_price);
                    },
                    'format' => 'raw'
                ],
                'location',
                [
                    'attribute' => 'proof_of_ownership',
                    'label' => 'Proof of Ownership',
                    'format' => 'raw',
                    'value' => function ($data) {
                        $url = Yii::getAlias('@web/html/collateral/') . $data->proof_of_ownership;
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
    <div class="col-lg-2" style="padding:12px;">
        <?= $this->render('registration/left-navigation', ['model' => $loan, 'active' => 'summary']); ?>            
    </div>
</div>
