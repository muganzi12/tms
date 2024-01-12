<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\location\VillageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Villages";
//Page descrition
$this->params['page_description'] = 'Villages';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Village';
$this->params['topright_button_link'] = ['village/add-new-village'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="village-index">



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id',
        'name',
        [
            'attribute' => 'municipality',
            'value' => function ($data) {
                return $data->municipalityName->name;
            }, 'format' => 'raw',
        ],
        [
            'attribute' => 'division',
            'value' => function ($data) {
                return $data->divisionName->name;
            }, 'format' => 'raw',
        ],
        [
            'attribute' => 'parish',
            'value' => function ($data) {
                return $data->parishName->name;
            }, 'format' => 'raw',
        ],
        //'created_at',
        //'created_by',
        //'updated_at',
        //'updated_by',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>


</div>
