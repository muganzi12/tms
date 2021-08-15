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
<div class="chart-of-accounts-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'account_name',
                'value' => function($data) {
                    return '<b><a href="' . Url::to(['account/view', 'id' => $data->id]) . '">' . $data->account_name . "</a></b>";
                },
                'format' => 'raw'
            ],
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
        //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
