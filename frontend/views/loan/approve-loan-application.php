<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'Approve Loan Application: ' . $model->reference_number;
//Pass LoanID to the layout 
$this->params['loan_id'] = $loanId;
?>

<div class="row">
    <div class="card" style="margin-left:50px; width: 100%">
        <div class="card-header bg-success d-flex align-items-center justify-content-between">
            <h4 class="card-header__title mb-0">Loan Application Details</h4>
        </div>
        <div class="card-body" style=padding:0px;>
            <?= $this->render('details/loan-details', ['model' => $model]); ?>
        </div>
    </div>

        <div class="card" style="margin-left:50px; width: 100%">
        <div class="card-header bg-info d-flex align-items-center justify-content-between">
            <h4 class="card-header__title mb-0">Approve loan Application</h4>
        </div>
        <div class="card-body approve-form" style=padding:0px;>
            <?= $this->render('_approval-form', [
                'model' => $model,
                'method' => $method,
            ]) ?>
        </div>
    </div>
</div>

