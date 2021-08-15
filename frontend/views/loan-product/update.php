<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanProduct */

$this->title = 'Update Loan Product: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Loan Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('registration/reg-steps-top-nav', ['model' => $model, 'active' => 'update']); ?>
<div class="row">

    <div class="col-lg-10" style="padding:0px;">

     
    <?= $this->render('_update-form', [
        'model' => $model,
        'currency' => $currency,
    ]) ?>


</div>
   <div class="col-lg-2" style="padding:0px;">
        <?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
    </div>
</div>