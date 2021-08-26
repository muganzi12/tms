<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanManagerRemarks */

$this->title = 'Enter  Remarks to Reject a Loan Application';
$this->params['breadcrumbs'][] = ['label' => 'Loan Manager Remarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Pass LoanID to the layout 
$this->params['loan_id'] = $loanId;
?>

<div class="row">  
    <div class="col-lg-12" style="padding:0px;"> 

    <?= $this->render('_loan-rejection-form', [
        'model' => $model,
        'loan' => $loan,
    ]) ?>


</div>

</div>
