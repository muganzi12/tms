<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\report\OverduePayments */

$this->title = 'Update Overdue Payments: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Overdue Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="overdue-payments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
