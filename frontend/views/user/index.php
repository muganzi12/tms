<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\client\Branch;
use yii\helpers\url;

$this->title = 'System Users';
//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New System User';
$this->params['topright_button_link'] = ['user/add-new-system-user'];
$this->params['topright_button_class'] = 'btn-success pull-right';
$inst = Yii::$app->member->client_id;
$this->title = 'System Users';
$this->params['breadcrumbs'][] = $this->title;
//Page descrition
$this->params['page_description'] = '';
?>
<div class="user-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'username',
            'firstname',
            'lastname',
            'othername',
            'telephone',
            'email',
            //'auth_key',
            //'password_hash',
            //'password_status',
            //'password_reset_token',
            //'email:email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->userStatus->css_class . '">' . $data->userStatus->name . '</a>';
                },
                'format' => 'raw'
            ],
            //'client_id',
            // 'branch_id',
            [
                'attribute' => 'branch_id',
                'value' => function($data) {
                    return '<b><a href="' . Url::to(['branch/view', 'id' => $data->branch->id]) . '">' . $data->branch->name . "</a></b>";
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'branch_id',
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'data' => ArrayHelper::map(Branch::find()->select(['id', 'name'])->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select a Branch ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
                'format' => 'raw'
            ],
            //'created_at',
            //'updated_at',
            //'verification_token',
            //'profile_pic',
            //'office_id',
            //'is_admin',
            //'app_module',
            //'telephone',
            //'login_at',
            //'passwrd_reset_at',
            //'created_by',
            //'updated_by',
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
