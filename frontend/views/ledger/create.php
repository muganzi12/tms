<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\loan\Ledger */

$this->title = 'Create Ledger';
$this->params['breadcrumbs'][] = ['label' => 'Ledgers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ledger-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
