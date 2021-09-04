<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\InvestorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Investors';
$this->params['breadcrumbs'][] = $this->title;
//Pass InvestmentID to the layout 
$this->params['investor_id'] = $investorId;
?>
<div class="investor-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'loan_product',
            // 'account_to_credit',
            // 'account_to_debit',
            [
                'attribute' => 'amount_to_invest',
                'value' => function($data) {
                    return number_format($data->amount_to_invest);
                },
                'format' => 'raw'
            ],
            'investment_duration',
            'interest_rate',
            [
                'attribute' => 'total_interest',
                'value' => function($data) {
                    return number_format($data->total_interest);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'expected_total_amount',
                'value' => function($data) {
                    return number_format($data->expected_total_amount);
                },
                'format' => 'raw'
            ],
        //'created_at',
        //'status',
        //'created_by',
        //'updated_at',
        //'updated_by',
        //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
