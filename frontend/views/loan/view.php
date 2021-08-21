<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


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
        <h2 class="section-title">Guarrantors</h2>
        <h2 class="section-title">Guarrantors</h2>
        <h2 class="section-title">Remarks</h2>
</div>

