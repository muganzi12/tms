<?php

use yii\helpers\Html;
use yii\grid\GridView;
use nullref\datatable\DataTable;
use common\models\Reports;

/* @var $this yii\web\View */
/* @var $searchModel common\models\report\LoanInterestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paid this Month';
$this->params['breadcrumbs'][] = $this->title;
$report = new Reports();
$payment = $report->getPaidThisMonth();
?>
<style>

   
    input[type="search"] {
        width:500px;
        border:1px solid green;
        padding:3px;
    }
</style>
<div class="loan-interest-index">

    <?php // echo $this->render('_interest_search', ['model' => $searchModel]); ?>




</div>



<table class="table">
    <thead>
        <tr>
            <th>Member Number</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>entry_period</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach ($payment AS $lg) { ?>
        <tr>
            <th><?= $lg['member_account']; ?></th>
            <td><?= $lg['description']; ?></td>
            <td><?= $lg['due_date']; ?></td>
            <td><?= $lg['entry_period']; ?></td>
            <td><?= number_format($lg['amount']); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<pre>
    
<?php print_r($payment);?>
</pre>