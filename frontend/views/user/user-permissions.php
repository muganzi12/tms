<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/*
 * User Groups
 */
$this->title = "User Permissions";
$auth = Yii::$app->authManager;

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Permission';
$this->params['topright_button_link'] = ['user/new-permission'];
$this->params['topright_button_class'] = 'btn-success pull-right';
$inst = Yii::$app->member->client_id;
$this->title = 'User Permissions';
$this->params['breadcrumbs'][] = $this->title;
//Page descrition
$this->params['page_description'] = '';
$groups = $auth->getRoles();
?>
<div class="user-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            //'name',
            [
                'attribute' => 'description',
                'header'=>'Permission',
                'value' => function($data) {
                    return $data->description;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'created_at',
                'header'=>'Recorded On',
                'value' => function($data) {
                    return Yii::$app->formatter->asDate($data->created_at);
                },
                'format' => 'raw'
            ],
            //'created_at:date',
            [
                'format' => 'raw',
                'value' => function($data) {
                    return
                    Html::a('<span class="glyphicon glyphicon-pencil"></span> Update', ['update', 'id' => $data['id']], ['title' => 'edit', 'class' => 'btn btn-info']).'   '.
                            Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['delete', 'id' => $data['id']], ['title' => 'delete', 'class' => 'btn btn-danger']);
                },
                'header' => 'OPTIONS'
            ],
        ],
    ]);
    ?>


</div>
