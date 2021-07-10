<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\sacco\Sacco */

$this->title = 'Update Sacco Details: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Saccos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['page_description'] ='';
?>
<div class="sacco-update">

    <?= $this->render('_branch-form', [
        'model' => $model,
    ]) ?>

</div>
