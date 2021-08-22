<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\client\MasterData;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loan Applications';
$this->params['breadcrumbs'][] = $this->title;
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
    <?= $this->render('details/page-header', ['model' => $client, 'active_menu' => 'loan']); ?>
      <?= $this->render('../client/registration/reg-steps-top-nav',['model'=>$client,'active'=>'loan']); ?>
      <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-10" style="padding:0px;">


    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute' => 'reference_number',
                'value' => function($data) {
                    return '<b><a href="' . Url::to(['loan/view', 'id' => $data->id]) . '">' . $data->reference_number . "</a></b>";
                },
                'format' => 'raw'
            ],
          
            //'loan_type',
            [
                'attribute' => 'amount_applied_for',
                'value' => function($data) {
                    return number_format($data->amount_applied_for);
                },
                'format' => 'raw'
            ],
            'application_date',
            //'disbursment_date',
            'interest_rate',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->loanStatus->css_class . '">' . $data->loanStatus->name . '</a>';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'status',
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'data' => ArrayHelper::map(MasterData::find()->where(['reference_table'=>'status'])->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select Status ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
                'format' => 'raw'
            ],
       
        ],
    ]);
    ?>

      </div>
        <div class="col-lg-2" style="padding:12px;">
            <?= $this->render('../client/registration/left-navigation', ['model' => $client, 'active' => 'summary']); ?>            
        </div>
    </div>
