<?php

use yii\helpers\Html;
use yii\grid\GridView;
use nullref\datatable\DataTable;
use common\models\Reports;
use common\models\loan\LoanPaymentSchedule;

/* @var $this yii\web\View */
/* @var $searchModel common\models\report\LoanInterestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aging Report';
$this->params['breadcrumbs'][] = $this->title;
$report = new LoanPaymentSchedule();
$payment = $report->getAgingReport();
$balance = LoanPaymentSchedule::getTotalPrincipal();
$princ = LoanPaymentSchedule::getPrincipalPaid();
$interest = LoanPaymentSchedule::getTotalInterest();
$interestpaid = LoanPaymentSchedule::getTotalInterestPaid();
$principal_30 = LoanPaymentSchedule::getTotalPrincipal30();
$princ_paid_30 = LoanPaymentSchedule::getTotalPrincipalPaid30();
$principal_60 = LoanPaymentSchedule::getTotalPrincipal60();
$principal_payment_60 = LoanPaymentSchedule::getTotalPrincipalPaid60();
$principal_61 = LoanPaymentSchedule::getTotalPrincipal61();
$princ_paid_61 = LoanPaymentSchedule::getTotalPrincipalPaid61();
$principal_90 = LoanPaymentSchedule::getTotalPrincipal90();
$princ_paid_90 = LoanPaymentSchedule::getTotalPrincipalPaid90();
?>
<style>


    input[type="search"] {
        width:500px;
        border:1px solid green;
        padding:3px;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Ref Number</th>
            <th>Client</th>
            <th>Princ Amount</th>
            <th>Princ Paid</th>
            <th>Intrst Amount</th>
            <th>Intrst Paid</th>
             <th>Due Date</th>
            <th>1-30(Normal)</th>
            <th>31-61(Watchful)</th>
            <th>61-90(Doubtful)</th>
            <th>>90(Loss)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($payment AS $lg) {
            $principal = $lg['principal_amount']-$lg['principal_paid'];
            ?>

            <tr>
                <th><?= $lg['reference_number']; ?></th>
                <th><?= $lg['clientname']; ?></th>
                <td><?= number_format($lg['principal_amount']); ?></td>
                <td><?= number_format($lg['principal_paid']); ?></td>
                <td><?= number_format($lg['interest_amount']); ?></td>
                <td><?= number_format($lg['interest_paid']); ?></td>
                 <td><?= $lg['next_date']; ?></td>
                <td><?= number_format($lg['days'] >= 0 && $lg['days'] <=30 ? $principal : 0); ?></td>
                <td><?= number_format($lg['days'] >= 31 && $lg['days'] <=60 ? $principal : 0); ?></td>
                <td><?= number_format($lg['days'] >= 61 && $lg['days'] <=90 ? $principal : 0); ?></td>
                <td><?= number_format($lg['days'] >= 91 ? $principal : 0); ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr class="bg-secondary text-white">
            <th>Total</th>
            <th></th>
            <td><?= number_format($balance['principal_due']); ?></td>
            <td><?= number_format($princ['principal_paid']); ?></td>
            <td><?= number_format($interest['interest_due']); ?></td>
            <td><?= number_format($interestpaid['interest_paid']); ?></td>
            <th></th>
            <td><?= number_format($principal_30['principal_30']-$princ_paid_30['principal_paid_30']); ?></td>
            <td><?= number_format($principal_60['principal_60']-$principal_payment_60['principal_paid_60']); ?></td>
             <td><?=number_format($principal_61['principal_61']-$princ_paid_61['principal_paid_61']); ?></td>
            <td><?= number_format($principal_90['principal_90']-$princ_paid_90['principal_paid_90']); ?></td>

        </tr>
    </tfoot>
</table>
    <pre>
        <?php print_r( number_format($principal_60['principal_60'])); ?>

</pre>