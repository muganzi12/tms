<?php

use common\models\assessment\AssessmentHelper;
use common\models\assessment\Training;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
$loanSchedule=$model->getPaymentSchedule(2);
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
                 <img src="<?= Url::base(true);?>/html/company/logo/<?= Yii::$app->companyConfig->logo; ?>" style="height: 120px;margin-left:80px;"/> 


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
<h5>Disbursement Date: <?= $model->disbursment_date; ?></h5>
<table class="pdftable" style="width:100%;">
    <thead>
        <tr>
            <th style='background:#444;color:white;'>Due Date</th>
            <th style='background:#444;color:white;'>Principal</th>
            <th style='background:#444;color:white;'>Interest</th>
            <th style='background:#444;color:white;'>Total Payments</th>
            <th style='background:#444;color:white;'>Closing Balance</th>
        </tr>
    </thead>
     <tbody>
          <?php foreach($loanSchedule AS $paySchedule){
            $schedule = $paySchedule->jsonSerialize();
            ?>
        <tr>
             <td>
                <?= Yii::$app->formatter->asDate($schedule['date']); ?>
            </td>
            <td>
                <?= Yii::$app->formatter->asCurrency($schedule['principalRounded'],'UGX'); ?>
            </td>
            <td>
                <?= Yii::$app->formatter->asCurrency($schedule['interestRounded'],'UGX'); ?>
            </td>
            <td>
                <?= Yii::$app->formatter->asCurrency($schedule['totalPaymentRounded'],'UGX'); ?>
            </td>
            <td>
                <?= Yii::$app->formatter->asCurrency($schedule['closingBalance'],'UGX'); ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>


