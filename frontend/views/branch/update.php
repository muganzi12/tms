<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Branch */

$this->title = 'Update Branch: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
//Page descrition
$this->params['page_description'] = '';
?>
<div class="branch-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
