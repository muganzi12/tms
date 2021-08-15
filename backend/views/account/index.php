<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = "Chart of Accounts";
//Page descrition
$this->params['page_description'] = 'Chart of Accounts';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'Add a New Account';
$this->params['topright_button_link'] = ['account/add-new-account'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="chart-of-accounts-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'gl_code',
            'account_name',
            [
                'attribute' => 'account_type',
                'value' => function($data) {
                    return $data->type->name;
                },
                'format' => 'raw'
            ],
            'description',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
