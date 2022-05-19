<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'Add Loan Collateral';
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Pass LoanID to the layout 
$this->params['loan_id'] = $loanId;
?>

<style>
    .profile-section{}
    .profile-section h5{
        border-bottom: 3px solid #3C8BE5;
        color:#135095;
        font-weight: bold !important;
    }
</style>
<section class="sheet padding-10mm" style="padding:0 7px 0 7px;">

    <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-12" style="padding:0px;">



        <?=
        $this->render('_application-fees-form', [
            'model' => $model,
            'loan' => $loan,
            'payment_methods' => $payment_methods
        ])
        ?>

    </div>

</div>
