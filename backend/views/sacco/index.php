<?php

use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\sacco\Branch;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

$this->title = "SACCOs";

$data = Json::decode($sacco);

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
$this->params['page_description'] = 'List of SACCOs';
?>
<p>
    <?= Html::a('New SACCO', ['new-sacco'], ['class' => 'btn btn-primary']) ?>
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
                    return Html::a($data['name'], ['view', 'id' => $data['id']]);
                },
                'format' => 'raw'],
            [
                'attribute' => 'brn',
                'header' => 'BRN',
                'value' => function($data) {
                    return $data['brn'];
                }
            ],
            [
                'attribute' => 'telephone',
                'header' => 'Other Name',
                'value' => function($data) {
                    return $data['telephone'];
                }
            ],
            [
                'attribute' => 'email',
                'header' => 'Email',
                'value' => function($data) {
                    return $data['email'];
                }
            ],
            [
                'attribute' => 'address',
                'header' => 'Address',
                'value' => function($data) {
                    return $data['address'];
                }
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>



