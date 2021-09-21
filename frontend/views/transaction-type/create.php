<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\loan\LedgerTransactionType */

$this->title = 'Create Ledger Transaction Type';
$this->params['breadcrumbs'][] = ['label' => 'Ledger Transaction Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ledger-transaction-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
