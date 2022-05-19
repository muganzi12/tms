<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\client\LoanAmortization;
use nullref\datatable\DataTable;
use yii\helpers\Url;
use common\models\client\Loan;

$this->title = $model->reference_number;
$this->params['loan_id'] = $model->id;
\yii\web\YiiAsset::register($this);
$balance = Loan::getTotalPrincipal($model->id);
$princ = Loan::getPrincipalPaid($model->id);
$interest = Loan::getTotalInterest($model->id);
$interestpaid = Loan::getTotalInterestPaid($model->id);
$totalrate = Loan::getTotalRate($model->id);
$loggedIn = Yii::$app->user;
 $count = count($model->borrowerRequirementList);
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
    <div class="profile-section" style="margin-top:0px;">
        <h5>Application Details</h5>
<?= $this->render('details/loan-details', ['model' => $model]); ?>
    </div>


</section>
    <?php if ($model->status == 41) { ?>
    <p>
    <?= Html::button('Download', ['class' => 'pull-right btn btn-secondary', 'onclick' => 'approvePayment()']) ?>
    </p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Due Date</th>
                <th>Principal Due</th>
                <th>Principal Paid</th>
                <th>Interest Due</th>
                <th>Interest Paid</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($model->loanScheduleEntries AS $lg) { ?>
                <tr>
                    <td><?= '<b><a href="' . Url::to(['loan/view-payments', 'id' => $lg->id]) . '">' . $lg->due_date . "</a></b>"; ?></td>
                    <td><?= number_format($lg->principal_amount); ?></td>
                    <td><?= number_format($lg->principal_paid); ?></td>
                    <td><?= number_format($lg->interest_amount); ?></td>
                    <td><?= number_format($lg->interest_paid); ?></td>
                </tr>
    <?php } ?>
        </tbody>
        <tfoot>
            <tr class="bg-secondary text-white">
                <td>TOTAL</td>
                <td>= <?= number_format($balance['principal_due']); ?></td>
                <td>= <?= number_format($princ['principal_paid']); ?></td>
                <td>= <?= number_format($interest['interest_due']); ?></td>
                <td>= <?= number_format($interestpaid['interest_paid']); ?></td>

            </tr>
        </tfoot>
    </table>

<?php }
?>
    
    <h5>Personal Loan Requirements</h5>
  <h5>1. Borrower</h5>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="info">
            <th>S/N</th>
            <th>Requirement</th>
            <th>Rate</th>
            <th>Option</th>

        </tr>
    </thead>
  
        <tbody>
            <?php
              $i=1;
            foreach ($model->borrowerRequirement AS $ge) {
                ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $ge->requirement->name ?></td>
                    <td><?= $ge->rate; ?></td>
                            <td>
                                <?= '<b class="btn btn-success"><a href="' . Url::to(['loan/check-requirements', 'id' => $ge->id, 'ln' => $ge->loan->id]) . '">' . '<span style="color:#fff;font-size:85%;">Mark ' . "</a></b>"; ?>
                           
                            </td>
                  
               
                </tr>
            <?php } ?>
        </tbody>
     
      
</table>
    
        <h5>2. Guarantor</h5>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="info">
            <th>S/N</th>
            <th>Requirement</th>
            <th>Rate</th>
            <th>Option</th>

        </tr>
    </thead>
  
        <tbody>
            <?php
              $i=1;
            foreach ($model->gurantorRequirement AS $ge) {
                ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $ge->requirement->name ?></td>
                    <td><?= $ge->rate; ?></td>
                            <td>
                                <?= '<b class="btn btn-success"><a href="' . Url::to(['loan/check-requirements', 'id' => $ge->id, 'ln' => $ge->loan->id]) . '">' . '<span style="color:#fff;font-size:85%;">Mark ' . "</a></b>"; ?>
                           
                            </td>
               
                </tr>
            <?php } ?>
        </tbody>
     
      
</table>
        <pre>
<?php   print_r($count);?>
        </pre>