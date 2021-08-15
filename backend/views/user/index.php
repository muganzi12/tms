<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
?>
<?= $this->render('../company/registration/reg-steps-top-nav', ['model' => $inst, 'active' => 'admin',]); ?>
<div class="az-dashboard-nav"> 
  <nav class="nav">

    </nav>
</div>

<div class="col-lg-9">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'username',
            'firstname',
            'lastname',
            //'auth_key',
            //'password_hash',
            //'password_status',
            //'password_reset_token',
            'email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->userStatus->css_class . '">' . $data->userStatus->name . '</a>';
                },
                'format' => 'raw'
            ],
            //'client_id',
            //'branch_id',
            //'created_at',
            //'updated_at',
            //'verification_token',
            //'profile_pic',
            //'office_id',
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



<div class="col-lg-3">
    <?= Html::a('Update Company details', ['company/update', 'id' => $inst->id], ['class' => 'btn btn-primary btn-block']) ?>
    <?= Html::a('New company admin', ['user/new-admin', 'id' => $inst->id], ['class' => 'btn btn-info btn-block']) ?>
    <?= Html::a('Upload Logo', ['update', 'id' => $inst->id], ['class' => 'btn btn-secondary btn-block']) ?>


</div>
