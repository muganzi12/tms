<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\loan\LedgerTransactionType */

$this->title = 'Update Ledger Transaction Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ledger Transaction Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ledger-transaction-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
