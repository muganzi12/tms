<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//Top Right button
$this->title = "Tenants";
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Tenant';
$this->params['topright_button_link'] = ['user/add-new-system-user'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="user-index">


    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id',
        'username',
        'firstname',
        'lastname',
        'othername',
        //'auth_key',
        //'password_hash',
        //'password_status',
        //'password_reset_token',
        //'email:email',
        //'status',
        //'created_at',
        //'updated_at',
        //'verification_token',
        //'profile_pic',
        //'office_id',
        //'is_admin',
        //'telephone',
        //'login_at',
        //'passwrd_reset_at',
        //'created_by',
        //'updated_by',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>


</div>
