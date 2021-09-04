<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\InvestmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Investments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Investment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'investor_id',
            'loan_product',
            'account_to_credit',
            'account_to_debit',
            //'amount_to_invest',
            //'investment_duration',
            //'interest_rate',
            //'total_interest',
            //'expected_total_amount',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
