<?php

/* @var $this yii\web\View */
/* @var $model common\models\account\AuthAssignment */

$this->title = 'Update Auth Assignment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Auth Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'item_name' => $model->item_name, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-assignment-update">


    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
