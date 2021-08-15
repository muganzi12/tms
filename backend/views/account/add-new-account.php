<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\ChartOfAccounts */

$this->title = 'Add a New Account';
$this->params['breadcrumbs'][] = ['label' => 'Chart Of Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chart-of-accounts-create">
    <?= $this->render('_form', [
        'model' => $model,
        'type'=>$type,
    ]) ?>

</div>
