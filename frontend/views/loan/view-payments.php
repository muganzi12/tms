<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\client\LoanAmortization;
use nullref\datatable\DataTable;
use yii\helpers\Url;
use common\models\loan\LoanPaymentSchedule;
use common\models\loan\Ledger;
use common\models\Reports;
use common\models\client\Loan;

$this->title = $model->due_date;
$this->params['schedule_id'] = $model->id;
$schedule_id = $this->params['schedule_id'];
\yii\web\YiiAsset::register($this);
$loan = common\models\loan\LoanPaymentSchedule::findOne($schedule_id);

$report = new LoanPaymentSchedule();
$payment = $report->getLoanScheduleEntries();
$loggedIn = Yii::$app->user;
$balance = Loan::getTotalPrincipal($model->loan->id);
$interest = Loan::getTotalInterest($model->loan->id);
$loan = Loan::findOne($model->loan->id);
$balances = Yii::$app->db->createCommand('SELECT SUM(principal_amount) AS principal_amount from loan_payment_schedule  WHERE loan_id =' . $model->loan->id)->queryOne();
$princ = Yii::$app->db->createCommand('SELECT SUM(principal_paid) AS principal_paid from loan_payment_schedule  WHERE loan_id =' . $model->loan->id)->queryOne();
$interests = Yii::$app->db->createCommand('SELECT SUM(interest_amount) AS interest_amount from loan_payment_schedule  WHERE loan_id =' . $model->loan->id)->queryOne();
$interestpaid = Yii::$app->db->createCommand('SELECT SUM(interest_paid) AS interest_paid from loan_payment_schedule  WHERE loan_id =' . $model->loan->id)->queryOne();
//Top Right button
?>
<style>
    .profile-section{}
    .profile-section h5{
        border-bottom: 3px solid #3C8BE5;
        color:#135095;
        font-weight: bold !important;
    }
</style>
<?php if ($model->principal_amount - $model->principal_paid == !0 && $model->principal_amount - $model->principal_paid > 0) { ?>
    <p>                   
        <a href='<?= Url::to(['loan/pay', 'id' => $model->id, 'ln' => $loan->id]); ?>' class='pull-right btn btn-success'> <i class="os-icon os-icon-download"></i>Make Payment</a>
    </p>
<?php }
?>

<br>

<table class="table table-striped table-bordered">
    <div class="row card-group-row">
        <div class="col-xl-4 col-md-6 card-group-row__col">
            <div class="card card-group-row__card card-body flex-row align-items-center">
                <div class="flex">
                    <div class="text-amount"style="font-size:22px;"><?= number_format($model->principal_amount); ?></div>
                    <div class="text-muted mt-1"style="font-size:12px;">PRINCIPAL</div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 card-group-row__col">
            <div class="card card-group-row__card card-body flex-row align-items-center">
                <div class="flex">
                    <div class="text-amount" style="font-size:22px;"><?= number_format($model->interest_amount); ?></div>
                    <div class="text-muted mt-1"style="font-size:12px;">INTEREST</div>

                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 card-group-row__col">
            <div class="card card-group-row__card card-body flex-row align-items-center">
                <div class="flex">
                    <div class="text-amount" style="font-size:22px;"><?= number_format($model->principal_amount - $model->principal_paid); ?></div>
                    <div class="text-muted mt-1"style="font-size:12px;">PRINCIPAL BALANCE</div>
                </div>
            </div>
        </div>
    </div>
</table>
<h5>Expected Amount</h5>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="info">
            <th>Due Date</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Option</th>

        </tr>
    </thead>
    <?php
    $count = count($model->loanScheduleEntries);

    if ($count > 0) {
        ?>
        <tbody>
            <?php
            if ($count > 0) {
                
            }
            foreach ($model->loanScheduleEntries AS $ge) {
                ?>
                <tr>
                    <td><?= $ge->due_date ?></td>
                    <td><?= $ge->description; ?></td>
                    <td><?= number_format($ge->amount); ?></td>
                    <td><?= '<a href="#" class="badge badge-block badge-' . $ge->ledgerStatus->css_class . '">' . $ge->ledgerStatus->name . '</a>'; ?></td>

                    <?php if ($ge->ledger_status == 43) { ?>
                        <?php if ($loggedIn->can('Approving Authority')) { ?>
                            <td>
                                <?= '<b class="btn btn-success"><a href="' . Url::to(['loan/approve-payments', 'id' => $ge->id, 'sch' => $ge->loanSchedule->id]) . '">' . '<span style="color:#fff;font-size:85%;">Approve ' . "</a></b>"; ?>
                                <?php if ($ge->ledger_status == 43) { ?>
                                    <?= '<b class="btn btn-danger"><a href="' . Url::to(['loan/reject-payments', 'id' => $ge->id, 'sch' => $ge->loanSchedule->id]) . '">' . '<span style="color:#fff;font-size:85%;">Reject ' . "</a></b>"; ?>
                                <?php }
                                ?>
                            </td>
                        <?php } ?>
                    <?php }
                    ?>
                </tr>
            <?php } ?>
        </tbody>
        <?php
    }
    ?>
</table>

<h5>Ledger Transactions</h5>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="info">
            <th>Payment date</th>
            <th>Description</th>
            <th>Amount Received</th>

        </tr>
    </thead>
    <?php
    $count = count($model->ledgerLoanScheduleEntries);

    if ($count > 0) {
        ?>
        <tbody>
            <?php
            if ($count > 0) {
                
            }
            foreach ($model->ledgerLoanScheduleEntries AS $ge) {
                ?>
                <tr>
                    <td><?= date('d-m-Y', $ge->created_at); ?></td>
                    <td><?= $ge->description; ?></td>
                    <td><?= number_format($ge->amount); ?></td>

                </tr>
            <?php } ?>
        </tbody>
        <?php
    } else {
        
    }
    ?>
</table>

<div class="profile-section">
    <h5>Proof of Payment</h5>
    <?= $this->render('details/receipts', ['model' => $model]); ?>
</div>



<pre>
    <?php
    $totalbal = ($balances['principal_amount'] - $princ['principal_paid']) + ($interests['interest_amount'] - $interestpaid['interest_paid']);
    if ($totalbal <= 0) {
        Yii::$app->db->createCommand('UPDATE loan SET status =86  WHERE id =' . $model->loan->id)->execute();
    } else {
        Yii::$app->db->createCommand('UPDATE loan SET status =41  WHERE id =' . $model->loan->id)->execute();
    }

    print_r($totalbal);
    ?>
</pre>
