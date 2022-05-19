<?php

use yii\helpers\Html;
use yii\grid\GridView;
use nullref\datatable\DataTable;
use common\models\Reports;

/* @var $this yii\web\View */
/* @var $searchModel common\models\report\LoanInterestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Balance Sheet';
$this->params['breadcrumbs'][] = $this->title;
$report = new Reports();
$payment = $report->getLedgerReport();
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
            <th>Due Date</th>
            <th>Member Number</th>
            <th>Description</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($payment AS $lg) { ?>
            <tr>
                <th><?= $lg['due_date']; ?></th>
                <th><?= $lg['member_account']; ?></th>
                <td><?= $lg['description']; ?></td>
                <td><?= number_format($lg['amount']); ?></td>
            </tr>
<?php } ?>
    </tbody>
</table>