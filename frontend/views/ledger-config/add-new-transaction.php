<?php

use yii\helpers\Html;

$this->title = 'New ledger transaction configuration';
?>
<div class="ledger-transaction-config-create">
    <?= $this->render('_form', [
        'model' => $model,
        'chartofaccounts'=>$chartofaccounts
    ]) ?>
</div>
