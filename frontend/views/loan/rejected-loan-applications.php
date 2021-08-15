<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loan Applications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

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
            [
                'attribute' => 'client_id',
                'value' => function($data) {
                    return $data->client->fullNames;
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
                'format' => 'raw',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->loanStatus->css_class . '">' . $data->loanStatus->name . '</a>';
                },
                'format' => 'raw'
            ],
        ],
    ]);
    ?>


</div>
