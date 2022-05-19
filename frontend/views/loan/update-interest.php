<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\loan\Ledger */

$this->title = 'Update this Record';
$this->params['breadcrumbs'][] = ['label' => 'Ledgers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['ledger_id'] = $ledgerId;
?>
<div class="ledger-update">
    <?= $this->render('_update-form', [
        'model' => $model,
    ]) ?>

</div>
