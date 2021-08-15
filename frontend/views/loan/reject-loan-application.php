<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanManagerRemarks */

$this->title = 'Enter  Remarks to Reject a Loan Application';
$this->params['breadcrumbs'][] = ['label' => 'Loan Manager Remarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('registration/reg-steps-top-nav', ['model' => $loan, 'active' => 'rejection']); ?>

<div class="row">  
    <div class="col-lg-10" style="padding:0px;"> 

    <?= $this->render('_loan-rejection-form', [
        'model' => $model,
        'loan' => $loan,
    ]) ?>


</div>
   <div class="col-lg-2" style="padding:12px;">
        <?= $this->render('registration/left-navigation', ['model' => $loan, 'active' => 'summary']); ?>            
    </div>
</div>
