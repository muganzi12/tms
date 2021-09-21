<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Master Data';
$this->params['breadcrumbs'][] = $this->title;
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
            'updated_at:date',
            'updated_by',
            'css_class',
           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
