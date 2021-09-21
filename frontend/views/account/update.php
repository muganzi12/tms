<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\ChartOfAccounts */

$this->title = 'Update Chart Of Accounts: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Chart Of Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chart-of-accounts-update">
    <?= $this->render('_form', [
        'model' => $model,
        'type'=>$type,
        'chartofaccounts'=>$chartofaccounts
    ]) ?>

</div>
