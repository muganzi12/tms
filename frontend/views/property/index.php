<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\property\PropertySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Properties";
//Page descrition
$this->params['page_description'] = 'Properties';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Property';
$this->params['topright_button_link'] = ['property/add-new-property'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="property-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        'name',
        [
            'attribute' => 'type',
            'value' => function ($data) {
                return $data->propertyType->name;
            }, 'format' => 'raw',
        ],
        //'description:ntext',
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
        [
            'attribute' => 'street',
            'value' => function ($data) {
                return $data->streetName->name;
            }, 'format' => 'raw',
        ],
        //'plot_number',
        //'house_number',
        //'attachment',
        //'created_at',
        //'created_by',
        //'updated_at',
        //'updated_by',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>


</div>
