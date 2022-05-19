


<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use nullref\datatable\DataTable;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Loan Applications';
$this->params['breadcrumbs'][] = $this->title;

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Client';
$this->params['topright_button_link'] = ['client/add-new-client'];
$this->params['topright_button_class'] = 'btn-success pull-right';
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


<!--  <p>

<?= Html::a('Import(Excel File)', ['import'], ['class' => 'btn btn-success   pull-right']) ?>

    </p>-->
<div class="member-index">



</div>

<table id="example" class="display" style="width:100%">
    <thead>
   
        <tr>
            <th>Passport</th>
            <th>Reference Number</th>
            <th>Client</th>
            <th>Amount</th>
            <th>Loan Period</th>
            <th>Interest Rate</th>
            <th>Status</th>
                <th>Status</th>
                 <th>Loan Officer</th>
        </tr>
  
    </thead>
    <tbody>
               <?php foreach ($data AS $lg) { ?>
        <tr>
            <td><?=$lg['profile'];?></td>
            <td><?=$lg['referenceNumber'];?></td>
            <td><?=$lg['fullNames'];?></td>
            <td><?=$lg['amountApplied'];?></td>
            <td><?=$lg['loan_period'];?></td>
            <td><?=@$lg['interest_rate'];?></td>
            <td><?=$lg['statusButton'];?></td>
             <td><?=$lg['loanOfficerNames'];?></td>
        </tr>
          <?php } ?>
 
     
    </tbody>

</table>