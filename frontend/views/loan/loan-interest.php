<?php

use yii\helpers\Html;
use yii\grid\GridView;
use nullref\datatable\DataTable;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\report\LoanInterestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loan Interests';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>


    input[type="search"] {
        width:500px;
        border:1px solid green;
        padding:3px;
    }
</style>
<div class="loan-interest-index">


</div>
<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        //'id',
        'entry_reference',
        'entry_reference_id',
        //'currency',
        //'processing_loan_fees',
        [
            'attribute' => 'amount',
            'value' => function($data) {
                return number_format($data->amount);
            },
            'format' => 'raw'
        ],
        [
            'attribute' => 'due_date',
            'value' => 'due_date',
            'format' => 'raw',
            'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'due_date',
                'presetDropdown' => true,
                'convertFormat' => true,
                'includeMonthsFilter' => true,
                'pluginOptions' => [
                    'locale' => [
                        'format' => 'Y-m-d',
                    ]
                ],
                'options' => [
                    'placeholder' => 'Select Due Date...'
                ]
            ]),
        ],
        'entry_period',
        'ledger_status'
    ],
]);
?>