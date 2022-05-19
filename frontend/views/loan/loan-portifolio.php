


<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use nullref\datatable\DataTable;
use common\models\loan\LoanPaymentSchedule;
/* @var $this yii\web\View */
/* @var $searchModel common\models\client\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'LOAN PORTIFOLIO';
$this->params['breadcrumbs'][] = $this->title;

$data = $dataProvider->getModels();
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

<div class="member-index">



</div>

<table id="example" class="display" style="width:100%">
    <thead>
   
        <tr>
            <th>Loan</th>
            <th>Client</th>
            <th>Principal Expected</th>
            <th>Principal Paid</th>
            <th>Principal Balance</th>
            <th>Interest Expected</th>
            <th>Interest Paid</th>
            <th>Interest Balance</th>
            <th>Period</th>
             <th>Disbursement Date</th>
            <th>Loan Officer</th>
          
        </tr>
  
    </thead>
    <tbody>
               <?php foreach ($data AS $lg) { ?>
        <tr>
           
            <td><?=@$lg['loan']['reference_number'];?></td>
             <td><?=@$lg['loan']['client']['fullNames'];?></td>
            <td><?=number_format($lg['principal_amount']);?></td>
            <td><?=number_format($lg['principal_paid']);?></td>
            <td><?=number_format($lg['principal_amount']-$lg['principal_paid']);?></td>
            <td><?=number_format($lg['interest_amount']);?></td>
            <td><?=number_format($lg['interest_paid']);?></td>
             <td><?=number_format($lg['interest_amount']-$lg['interest_paid']);?></td>
              <td><?=@$lg['loan']['loan_period'];?></td>
               <td><?=date('y-m-d',@$lg['created_at']);?></td>
              <td><?=@$lg['createdBy']['fullNames'];?></td>
             
        </tr>
          <?php } ?>
 
     
    </tbody>
    
       <tfoot>
        <tr class="bg-secondary text-white">
            <th>Total</th>
            <th></th>
            <td><?= number_format($balance['principal_due']); ?></td>
            <td><?= number_format($princ['principal_paid']); ?></td>
            <td><?= number_format($balance['principal_due']-$princ['principal_paid']); ?></td>
             <td><?= number_format($interest['interest_due']); ?></td>
            <td><?= number_format($interestpaid['interest_paid']); ?></td>
            <td><?= number_format($interest['interest_due']-$interestpaid['interest_paid']); ?></td>
            <td></td>
             <td></td>
             <td></td>

        </tr>
    </tfoot>

</table>