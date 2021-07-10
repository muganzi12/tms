<?php

use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\member\Member;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

$this->title = "Members";


$data = Json::decode($member);

$dataProvider = new ArrayDataProvider([
    'allModels' => $data,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'attributes' => ['id'],
    ],
        ]);
$searchModel = new Member();
//Page descrition
$this->params['page_description'] = 'Members';
?>
<style>
    .grid-view table thead {
        background: #000428;
        background: -webkit-linear-gradient(45deg, #000428, #004e92) !important;
        background: linear-gradient(45deg, #000428, #004e92) !important;
    }
</style>
<p>
     <?= Html::a('Create Member', ['new-member'], ['class' => 'btn btn-primary']) ?>
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
            ['attribute' => 'member_id_number',
                'value' => function($data) {
                    return Html::a($data['member_id_number'], ['view', 'id' => $data['id']]);
                },
                'format' => 'raw'],
            [
                'attribute' => 'firstname',
                'header' => 'First Name',
                'value' => function($data) {
                    return $data['firstname'];
                }
            ],
            [
                'attribute' => 'lastname',
                'header' => 'Last Name',
                'value' => function($data) {
                    return $data['lastname'];
                }
            ],
            [
                'attribute' => 'othername',
                'header' => 'Other Name',
                'value' => function($data) {
                    return $data['othername'];
                }
            ],
            [
                'attribute' => 'primary_telephone',
                'header' => 'Primary Telephone',
                'value' => function($data) {
                    return $data['primary_telephone'];
                }
            ],
                       [
                'attribute' => 'secondary_telephone',
                'header' => 'Secondary Telephone',
                'value' => function($data) {
                    return $data['secondary_telephone'];
                }
            ],
            [
                'attribute' => 'gender',
                'header' => 'Gender',
                'value' => function($data) {
                    return $data['gender'];
                }
            ],

            [
                'attribute' => 'marital_status',
                'header' => 'Marital Status',
                'value' => function($data) {
                    return $data['marital_status'];
                }
            ],
            [
                'attribute' => 'date_of_birth',
                'header' => 'Date of Birth',
                'value' => function($data) {
                    return $data['date_of_birth'];
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



