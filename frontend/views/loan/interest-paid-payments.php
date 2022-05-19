<?php

use yii\helpers\Html;
use yii\grid\GridView;
use nullref\datatable\DataTable;
use common\models\Reports;

/* @var $this yii\web\View */
/* @var $searchModel common\models\report\LoanInterestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$report = new Reports();
$over_due = $report->getOverDuePayments();
$total = $report->getDueInterestAmount();
$this->title = 'DUE AMOUNT: '.number_format($total['due_payments']);
$this->params['breadcrumbs'][] = $this->title;
$data = $dataProvider->getModels();
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
            <th>Passport</th>
            <th>Account Number</th>
            <th>Client Name</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Amount</th>
            <th>Period</th>
             <th>Status</th>
        </tr>
  
    </thead>
    <tbody>
               <?php foreach ($data AS $lg) { ?>
        <tr>
           
            <td><?=$lg['profile'];?></td>
            <td><?=$lg['member_account'];?></td>
            <td><?=$lg['fullNames'];?></td>
            <td><?= $lg['description'];?></td>
            <td><?=$lg['due_date'];?></td>
            <td><?=$lg['transactionAmount'];?></td>
            <td><?=$lg['entry_period'];?></td>
            <td><?=$lg['statusButton'];?></td>
        </tr>
          <?php } ?>
 
     
    </tbody>

</table>
