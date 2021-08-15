<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\masterdata\Company;
use yii\helpers\url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
?>

<div class="client-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'client_id',
                'value' => function($data) {
                    return '<b><a href="' . Url::to(['company/view','id' => $data->client->id]) . '">' . $data->client->name . "</a></b>";
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'client_id',
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'data' => ArrayHelper::map(Company::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select a Client ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
                'format' => 'raw'
            ],
            'username',
            'firstname',
            'lastname',
            'email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->userStatus->css_class . '">' . $data->userStatus->name . '</a>';
                },
                'format' => 'raw'
            ],
            [
                'format' => 'raw',
                'value' => function($data) {
                    return
                    Html::a('<span class="glyphicon glyphicon-pencil"></span> Update', ['update', 'id' => $data['id']], ['title' => 'edit', 'class' => 'btn btn-info']);
                },
                'header' => 'OPTIONS'
            ],
        ],
    ]);
    ?>


</div>

