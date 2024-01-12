<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\property\PropertyUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Property Units";
//Page descrition
$this->params['page_description'] = 'Property Units';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Property Unit';
$this->params['topright_button_link'] = ['property-unit/add-new-property-unit'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="property-unit-index">

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id',
        'name',
        [
            'attribute' => 'property',
            'value' => function ($data) {
                return $data->propertyName->name;
            }, 'format' => 'raw',
        ],
        'unit_number',
        'status',
        [
            'attribute' => 'unit_type',
            'value' => function ($data) {
                return $data->unitType->name;
            }, 'format' => 'raw',
        ],
        'rate',
        //'created_at',
        //'created_by',
        //'updated_at',
        //'updated_by',

        ['class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['style' => 'width: 110px'],
            'template' => '{update} {details}',
            'buttons' => [
                'details' => function ($url, $model) {
                    return Html::a('<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">library_books</i>', ['property-unit/view', 'id' => $model->id]);
                },
                'update' => function ($url, $model) {
                    return Html::a('<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">edit</i>', ['property-unit/update', 'id' => $model->id]);
                },
            ],
        ],
    ],
]);?>


</div>
