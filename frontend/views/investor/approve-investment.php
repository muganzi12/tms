<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'Approve Investment';
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
//Pass LoanID to the layout 
$this->params['investment_id'] = $investmentId;
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
        $this->render('_approve-form', [
            'model' => $model,
            'investment' => $investment,
             'ledgerEntries'=>$ledgerEntries,
        ])
        ?>

    </div>

</div>

