<?php
/*
 * Details of a file
 */
?>
<div class="row">

    <div class="col-lg-12">
        <table class="table">
            <tr>
                <td><b>Reference Number</b><br/>
                    <?= $model->reference_number; ?></td>
                <td>
                    <b>First Name</b><br/>
                    <?= $model->client->firstname; ?>
                </td>
                <td>
                    <b>Last Name</b><br/>
                    <?= $model->client->lastname; ?>
                </td>
                <td>
                    <b>Other Name</b><br/>
                    <?= $model->client->othername; ?>
                </td>
            </tr>
            <tr>
            
                <td>
                    <b>Amount Applied For</b><br/>
                    <?= Yii::$app->formatter->asCurrency($model->amount_applied_for,'UGX'); ?>
                </td>
                <td>
                    <b>Amount Approved</b><br/>
                    <?= number_format($model->amount_approved); ?>
                </td>
                     <td><b>Interest Rate</b><br/>
                    <?= Yii::$app->formatter->asPercent($model->interest_rate/100); ?></td>
                <td>
                    <b>Interest Frequency</b><br/>
                    <?= $model->interest_frequency; ?>
                </td>
            </tr>
            <tr>
                <td></td>
                     <td>
                    <b>Application Date</b><br/>
                    <?= date('d-m-Y',$model->created_at); ?>
                </td>
                     <td>
                    <b>Disbursement Date</b><br/>
                    <?= $model->disbursment_date; ?>
                </td>
                <td>
                    <b>Installment Frequency</b><br/>
                    <?= $model->installment_frequency; ?>
                </td>
             
            </tr>


        </table>
    </div>
</div>