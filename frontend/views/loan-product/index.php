<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = "Loan Products";
//Page descrition
$this->params['page_description'] = 'Loan Products';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'Add a New Loan Product';
$this->params['topright_button_link'] = ['loan-product/add-new-loan-product'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="loan-product-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'name',
            'product_code',
            //'description',
            'interest_rate',
            //'currency',
            //'processing_loan_fees',
            'minimum_amount',
            'maximum_amount',
            'principal_installment_frequency',
            'interest_frequency',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->productStatus->css_class . '">' . $data->productStatus->name . '</a>';
                },
                'format' => 'raw'
            ],
            //'maximum_repayment_period',
            //'number_of_installments',
            //'status',
            //'penalty',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            ['class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['style' => 'width: 110px'],
            'template'=>'{update} {details}',
              'buttons'=>[
                'details'=>function ($url, $model) {
                   return Html::a('<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">library_books</i>', ['loan-product/view','id'=>$model->id]);
                },
                'update'=>function ($url, $model) {
                   return Html::a('<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">edit</i>', ['loan-product/update','id'=>$model->id]);
                },
              ],
        ],
        ],
    ]);
    ?>


</div>
