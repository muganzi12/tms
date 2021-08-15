<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanProduct */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Loan Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?= $this->render('registration/reg-steps-top-nav', ['model' => $model, 'active' => 'profile']); ?>
<div class="row">

    <div class="col-lg-10" style="padding:0px;">

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'name',
                'description',
                'interest_rate',
                [
                    'attribute' => 'account_to_credit',
                    'value' => function($data) {
                        return $data->accountToCredit->gl_code;
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'account_to_debit',
                    'value' => function($data) {
                        return $data->accountToDebit->gl_code;
                    },
                    'format' => 'raw'
                ],
                'processing_loan_fees',
                'minimum_amount',
                'maximum_amount',
                'maximum_repayment_period',
                'status',
                'penalty',
                'created_at',
                'created_by',
            ],
        ])
        ?>

    </div>
    <div class="col-lg-2" style="padding:0px;">
<?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
    </div>
</div>