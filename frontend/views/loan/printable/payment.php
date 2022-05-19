<?php

use common\models\assessment\AssessmentHelper;
use common\models\assessment\Training;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\client\Loan;

$balance = Loan::getTotalPrincipal($model->id);
$princ = Loan::getPrincipalPaid($model->id);
$interest = Loan::getTotalInterest($model->id);
$interestpaid = Loan::getTotalInterestPaid($model->id);
/*
 * Assessment SummaryReport for download
 */
?>
<div style="border-bottom: 3px solid #069;">
    <table class='table table-borderless' style="padding:0px;margin:0px;">
        <tr>
            <td width='33%' class='text-left'>
                <b>Demos Capital Ltd</b><br/>
                <b>Tel:</b> +496920136863<br/>
                <b>Address:Kampala Uganda </b><br/>

            </td>
            <td width='34%' class='text-center'>
                <img src="<?= Yii::getAlias('@web/html'); ?>/images/demos.png" style="height: 120px;margin-left:80px;"/> 


            </td>
            <td width='33%'>
                <b>Email:</b> info@demoscapital.com<br/>
                <b>Website: </b>www.plutinum.com<br/>
            </td>
        </tr>
    </table>
</div>

<table class="table">
    <tr>
        <td>Client:  <b><?= $model->client->firstname.' '.$model->client->lastname; ?> </b><br/>
           </td>
    
    </tr>
    <tr>

        <td>
           Email: <b><?= $model->client->email; ?></b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
           <td>
           Telephone: <b><?= $model->client->telephone; ?></b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
         <td>
           File no: <b><?= $model->client->external_id; ?></b>
        </td>
      
    </tr>
    
       <tr>

        <td>
           Address: <b><?= $model->client->address; ?></b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
           <td>
           NIN: <b><?= $model->client->nin; ?></b>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
         <td>
           Issue date: <b> <?= date('Y-m-d'); ?></b>
        </td>
      
    </tr>
 


</table>
<br>

<table class="pdftable" style="width:100%;">
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
                <td><?= $lg->due_date; ?></td>
                <td><?= number_format($lg->principal_amount); ?></td>
                <td><?= number_format($lg->principal_paid); ?></td>
                <td><?= number_format($lg->interest_amount); ?></td>
                <td><?= number_format($lg->interest_paid); ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr class="bg-secondary text-white">
            <td><b>TOTAL</b></td>
            <td>= <?= number_format($balance['principal_due']); ?></td>
            <td>= <?= number_format($princ['principal_paid']); ?></td>
            <td>= <?= number_format($interest['interest_due']); ?></td>
            <td>= <?= number_format($interestpaid['interest_paid']); ?></td>

        </tr>
    </tfoot>
</table><br>

<p>Remarks/Notes...................................................................................................................................................................</p>
<p>......................................................................................................................................................................</p><br>
<p style="text-align: right">Signature.............................................</p>


