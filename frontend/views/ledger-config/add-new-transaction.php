<?php

use yii\helpers\Html;

$this->title = 'New ledger transaction configuration';
?>
<div class="ledger-transaction-config-create">
    <?= $this->render('_new-transaction-form', [
        'model' => $model,
        'chartofaccounts'=>$chartofaccounts,
        'product'=>$product,
        'label'=>$label
    ]) ?>
</div>
