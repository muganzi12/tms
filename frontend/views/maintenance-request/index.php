<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\property\MaintenanceRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maintenance Requests';
$this->params['breadcrumbs'][] = $this->title;
$this->title = "Maintenance Requests";
//Page descrition
$this->params['page_description'] = 'Maintenance Requests';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'Request Maintenance';
$this->params['topright_button_link'] = ['maintenance-request/add-new-request'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="maintenance-request-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        'property_id',
        'unit',
        'request_date',
        'maintainer',
        'issue_type',
        'status',
        //'attachment',
        //'notes:ntext',
        //'created_at',
        //'created_by',
        //'updated_at',
        //'updated_by',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>


</div>
