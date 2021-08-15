<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanProduct */

$this->title = 'Create Loan Product';
$this->params['breadcrumbs'][] = ['label' => 'Loan Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
      
    ]) ?>

</div>
