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
//Pass CLientID to the layout 
$this->params['client_id'] = $clientId;
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
<h2 style="border-bottom:2px solid 3px;color:#069;">Loan Applications</h2>
    <div class="profile-section" style="margin-top:20px;">
    
        <div class="col-lg-12" style="padding:0px;">


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
   
    </div>
