<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\report\OverduePayments */

$this->title = 'Create Overdue Payments';
$this->params['breadcrumbs'][] = ['label' => 'Overdue Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="overdue-payments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
