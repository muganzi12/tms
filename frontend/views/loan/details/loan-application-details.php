<?php
/*
 * Details of a file
 */
?>
<div class="row">

    <div class="col-lg-9">
        <table class="table">
            <tr>
                <td><b>Reference Number</b><br/>
                    <?= $model->reference_number; ?></td>
                <td>
                    <b>Loan Product Name</b><br/>
                    <?= $model->loanType->name; ?>
                </td>
                <td>
                    <b>Amount Applied For</b><br/>
                    <?= $model->amount_applied_for; ?>
                </td>
                <td>
                    <b>Approved Amount</b><br/>
                    <?= $model->amount_approved; ?>
                </td>
            </tr>
            <tr>
                <td><b>Application Date</b><br/>
                    <?= $model->application_date; ?></td>
                <td>
                    <b>Interest Rate</b><br/>
                    <?= $model->interest_rate; ?>
                </td>
              
                <td>
                    <b>Interest Frequency</b><br/>
                    <?= $model->interest_frequency; ?>
                </td>
            </tr>
            <tr>
                <td><b>Install Frequency</b><br/>
                    <?= $model->installment_frequency; ?></td>
                <td>
                    <b>Payment Installment Amount</b><br/>
                    <?= $model->payment_installment_amount; ?>
                </td>
               
                <td>
                    <b>Installment Payment Start Date</b><br/>
                    <?= $model->installment_payment_start_date; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Installment Payment Last Date</b><br/>
                    <?= $model->installment_payment_last_date; ?>
                </td>
                <td>
                    <b>Date recorded</b><br/>
                      <?= $model->interest_payment_start_date; ?>
                </td>
            </tr>

        </table>
    </div>
</div>