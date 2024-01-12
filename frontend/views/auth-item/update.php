<?php

/* @var $this yii\web\View */
/* @var $model common\models\account\AuthItem */

$this->title = 'Update Permission: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Auth Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-item-update">

    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
