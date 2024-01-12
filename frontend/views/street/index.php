<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\location\StreetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Streets";
//Page descrition
$this->params['page_description'] = 'Streets';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Street';
$this->params['topright_button_link'] = ['street/add-new-street'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="street-index">

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
        [
            'attribute' => 'village',
            'value' => function ($data) {
                return $data->villageName->name;
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
