<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'Approve Loan Application: ' . $model->reference_number;
//Pass LoanID to the layout 
$this->params['loan_id'] = $loanId;
?>

<div class="row">

    <div class="col-lg-12" style="padding:0px;">


    <?= $this->render('_approval-form', [
        'model' => $model,
        'method' => $method,
    ]) ?>

    </div>

</div>

