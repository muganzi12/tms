<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\report\OverduePaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Overdue Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="overdue-payments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Overdue Payments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'description',
            'entry_reference',
            'amount',
            'debit_account',
            //'credit_account',
            //'due_date',
            //'entry_type',
            //'entry_reference_id',
            //'stage',
            //'created_at',
            //'created_by',
            //'member_account',
            //'entry_period',
            //'updated_at',
            //'updated_by',
            //'ledger_status',
            //'interest_status',
            //'cancel_interest_reason',
            //'payment_ref',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
