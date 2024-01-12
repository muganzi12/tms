<?php

/* @var $this yii\web\View */
/* @var $model common\models\account\AuthItem */

$this->title = 'Register New Permission';
$this->params['breadcrumbs'][] = ['label' => 'Auth Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">


    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
