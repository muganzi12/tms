<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\location\DivisionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Divisions";
//Page descrition
$this->params['page_description'] = 'Divisions';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Division';
$this->params['topright_button_link'] = ['division/add-new-division'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="division-index">



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        'name',
        [
            'attribute' => 'municipality',
            'value' => function ($data) {
                return $data->municipalityName->name;
            }, 'format' => 'raw',
        ],
        'created_at',
        'created_by',
        //'updated_at',
        //'updated_by',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>


</div>
