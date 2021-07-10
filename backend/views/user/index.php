
<?php

use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

$this->title = "List of System Users";


$data = Json::decode($user);

$dataProvider = new ArrayDataProvider([
    'allModels' => $data,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'attributes' => ['id'],
    ],
        ]);
$searchModel = new User();
//Page descrition
$this->params['page_description'] = 'List of System Users';
?>
<p>
     <?= Html::a('New User', ['new-user'], ['class' => 'btn btn-primary']) ?>
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
            ['attribute' => 'username',
                'value' => function($data) {
                    return Html::a($data['username'], ['view', 'id' => $data['id']]);
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
                'attribute' => 'telephone',
                'header' => 'Telephone',
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
           
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>


