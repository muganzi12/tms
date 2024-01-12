<?php

/* @var $this yii\web\View */
/* @var $model common\models\account\AuthAssignment */

$this->title = 'Assign Permission';
$this->params['breadcrumbs'][] = ['label' => 'Auth Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create">

    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
