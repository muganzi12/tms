<?php

use yii\grid\GridView;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel common\models\property\PropertyUnitsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Property Types";
//Page descrition
$this->params['page_description'] = 'Property Types';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Property Type';
$this->params['topright_button_link'] = ['property-type/add-new-property-type'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="property-units-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        'name',
        'status',
        'created_at',
        //'created_by',
        //'updated_at',
        //'updated_by',

        ['class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['style' => 'width: 110px'],
            'template' => '{update} {details}',
            'buttons' => [
                'details' => function ($url, $model) {
                    return Html::a('<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">library_books</i>', ['property-type/view', 'id' => $model->id]);
                },
                'update' => function ($url, $model) {
                    return Html::a('<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">edit</i>', ['property-type/update', 'id' => $model->id]);
                },
            ],
        ],
    ],
]);?>


</div>
