<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'Disburse Loan';
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
//Pass LoanID to the layout 
$this->params['loan_id'] = $loanId;
?>

<div class="row">

    <div class="col-lg-12" style="padding:0px;">


        <?=
        $this->render('_loan-rejection-form', [
            'model' => $model,
            'loan' => $loan,
        ])
        ?>

    </div>

</div>

