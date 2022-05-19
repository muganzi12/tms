<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Master Data';
$this->params['breadcrumbs'][] = $this->title;
$me = $_GET['tbl'];

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Record';
$this->params['topright_button_link'] = ['master-data/add-new-record','tbl' => $me];
$this->params['topright_button_class'] = 'btn-success pull-right';
$inst = Yii::$app->member->client_id;
$this->title = 'Master Data Records';
$this->params['breadcrumbs'][] = $this->title;
//Page descrition
$this->params['page_description'] = '';
?>
<div class="master-data-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'description:ntext',
            'created_by',
            'created_at:date',
            //'updated_at:date',
            //'updated_by',
            //'css_class',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
