<?php

use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\sacco\Branch;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

$this->title = "Branches";

$data = Json::decode($branch);

$dataProvider = new ArrayDataProvider([
    'allModels' => $data,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'attributes' => ['id'],
    ],
        ]);
$searchModel = new Branch();
//Page descrition
$this->params['page_description'] = 'List of Branches';
?>
<p>
     <?= Html::a('Create Branch', ['new-branch'], ['class' => 'btn btn-primary']) ?>
    <br/>
<div class="box">
  
    <?php Pjax::begin(); ?>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped'],
        'summary' => '',
        'columns' => [
            ['attribute' => 'name',
                'value' => function($data) {
                    return $data['name'];
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'telephone',
                'header' => 'Other Name',
                'value' => function($data) {
                    return $data['telephone'];
                }
            ],
            [
                'attribute' => 'address',
                'header' => 'Address',
                'value' => function($data) {
                    return $data['address'];
                }
            ],
         ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {view}'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>



