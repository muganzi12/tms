<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\client\LoanAmortization;

$this->title = $model->reference_number;
$this->params['loan_id'] = $model->id;
\yii\web\YiiAsset::register($this);
?>
<style>
    h2.section-title{
        border-bottom:3px solid #069;
        display:block;
    }
    </style>
<div class="row">
    <h2 class="section-title">Loan application details</h2>
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'reference_number',
                [
                    'attribute' => 'client_id',
                    'value' => function($data) {
                        return $data->client->fullNames;
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'loan_type',
                    'value' => function($data) {
                        return $data->loanType->name;
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'amount_applied_for',
                    'value' => function($data) {
                        return number_format($data->amount_applied_for);
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'amount_approved',
                    'value' => function($data) {
                        return number_format($data->amount_approved);
                    },
                    'format' => 'raw'
                ],
                'application_date',
                //'disbursment_date',
                'status',
                'interest_rate',
                'interest_frequency',
                'installment_frequency',
                'payment_installment_amount',
                'installment_payment_start_date',
                'installment_payment_last_date',
                'interest_payment_start_date',
                'interest_payment_last_date',
                'loan_period',
                'created_at:date',
            //'created_by',
            ],
        ])
        ?>
        <h2 class="section-title">Payment Schedule</h2>
        <?php
           $start_date = new DateTime('2021-07-12');
            $loan = new LoanAmortization();
            $loan->setPrincipal(18000000);
            $loan->setInterestRate(20.1);
            $loan->setTerm(36);

            $schedule = $loan->getBreakdownByMonth();
        ?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Due Date</th>
            <th>Opening Balance</th>
            <th>Monthly Payment</th>
            <th>Interest</th>
            <th>Principal</th>
            <th>Closing Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($schedule as $payment){
            $monthly=$payment->jsonSerialize();
            ?>
        <tr>
            <th><?= $monthly['date']; ?></th>
            <td><?= Yii::$app->formatter->asCurrency($monthly['openingBalance'],'UGX'); ?></td>
            <td><?= Yii::$app->formatter->asCurrency($monthly['totalPaymentRounded'],'UGX'); ?><br/>
           <div class="text-stats text-success"><?= number_format(($monthly['totalPaymentRounded']-$monthly['totalPayment']),2);?><i class="material-icons">arrow_upward</i></div>    
        </td>
            <td>
                <?= Yii::$app->formatter->asCurrency($monthly['interestRounded'],'UGX'); ?><br/>
                <div class="text-stats text-success"><?= number_format(($monthly['interestRounded']-$monthly['interestDue']),2);?><i class="material-icons">arrow_upward</i></div>
            </td>
            <td><?= Yii::$app->formatter->asCurrency($monthly['principalRounded'],'UGX'); ?><br/>
            <div class="text-stats text-success"><?= number_format(($monthly['principalRounded']-$monthly['principalDue']),2);?><i class="material-icons">arrow_upward</i></div>
        </td>
            <td><?= Yii::$app->formatter->asCurrency($monthly['closingBalance'],'UGX'); ?></td>
        </tr>
        <?php }; ?>
    </tbody>
</table>
        <h2 class="section-title">Guarrantors</h2>
        <h2 class="section-title">Remarks</h2>
</div>

