<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Register New User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] ='';
?>
<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
        'modules'=>$modules
    ]) ?>

</div>
