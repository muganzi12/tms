<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\loan\LedgerTransactionConfig */

$this->title = 'Update Ledger Transaction Config: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ledger Transaction Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ledger-transaction-config-update">
    <?= $this->render('_form', [
        'model' => $model,
        'chartofaccounts'=>$chartofaccounts
    ]) ?>

</div>
