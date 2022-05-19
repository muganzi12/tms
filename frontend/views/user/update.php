<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update User: ' . $model->firstname.' '. $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
//Page descrition
$this->params['page_description'] = '';
//Pass CLientID to the layout 
$this->params['user_id'] = $userId;
?>
<div class="user-update">

    <?= $this->render('_update-form', [
        'model' => $model,
    ]) ?>

</div>
