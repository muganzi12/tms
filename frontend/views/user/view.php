<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->firstname . ' ' . $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Pass CLientID to the layout 
$this->params['user_id'] = $userId;
\yii\web\YiiAsset::register($this);

//Roles
$auth = Yii::$app->authManager;
$test= new \common\models\rbac\AuthAssignment();
$roles = $auth->getRolesByUser($model->id);
?>
<div class="user-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'firstname',
            'lastname',
            'othername',
            'email:email',
            [
                'attribute' => 'office_id',
                'format' => 'raw',
                'value' => function($data) {
                    return @$data->officeHeld;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->userStatus->css_class . '">' . $data->userStatus->name . '</a>';
                },
                'format' => 'raw'
            ],
            'created_at:date',
            'telephone',
        ],
    ])
    ?>
    <hr/>
    <h3>Roles/Permissions<a href="<?= Url::to(['user/add-new-role', 'id' => $model->id]); ?>" class="btn btn-primary float-right"><i class="fa fa-plus-circle"></i> Assign New Role</a></h3>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 30%">Role </th>
                <th style="width: 30%">Description</th>
                <th>Date Assigned</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($model->roles AS $rol) { ?>
                <tr>
                    <td><?= $rol->item_name; ?> </td>
                    <td><?= $rol->item_name; ?> </td>
                    <td><?= Yii::$app->formatter->asDate($rol->created_at); ?></td>
                    <td>
                        <a href="<?= Url::to(['user/delete-member', 'id' => $model->id, 'id' => $rol->id]); ?>" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Remove from Group</a>
                    </td>
                </tr>
<?php } ?>
        </tbody>
    </table>

</div>
