<?php

use yii\helpers\Html;
use yii\grid\GridView;
use nullref\datatable\DataTable;
use common\models\Reports;

/* @var $this yii\web\View */
/* @var $searchModel common\models\report\LoanInterestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$report = new Reports();
$total = $report->getPaidPrincipalAmount();
$this->title = 'OVERDUE AMOUNT: '.number_format($total['due_payments']);
$this->params['breadcrumbs'][] = $this->title;
 $data = $model->principalDue;
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
            <th>Reference Number</th>
            <th>Client</th>
            <th>Account Number</th>
            <th>Amount</th>
            <th>Period</th>
        </tr>
  
    </thead>
    <tbody>
               <?php foreach ($data AS $lg) { ?>
        <tr>
           
            <td><?=$lg['reference_number'];?></td>
            <td><?=$lg['clientname'];?></td>
            <td><?=$lg['member_account'];?></td>
            <td><?= number_format($lg['amount']);?></td>
            <td><?=$lg['entry_period'];?></td>
        </tr>
          <?php } ?>
 
     
    </tbody>

</table>

