<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update ' . $model->firstname. ' '. $model->lastname.' '.'Details';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['page_description'] = '';
?>
<div> 
 
    <?= $this->render('_update-form', [
        'model' => $model,
    ]) ?>

</div>

