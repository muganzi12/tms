<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = $model->reference_number;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= $this->render('registration/reg-steps-top-nav', ['model' => $model, 'active' => 'loan']); ?>

<div class="row">

    <div class="col-lg-10" style="padding:0px;">


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


    </div>
    <div class="col-lg-2" style="padding:12px;">
        <?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
    </div>
</div>

