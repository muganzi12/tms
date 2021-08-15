<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->firstname.' '.$model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'firstname',
            'lastname',
            'auth_key',
            'password_hash',
            'password_status',
            'password_reset_token',
            'email:email',
            'status',
            'client_id',
            'branch_id',
            'created_at',
            'updated_at',
            'verification_token',
            'profile_pic',
            'office_id',
            'app_module',
            'telephone',
            'login_at',
            'passwrd_reset_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
