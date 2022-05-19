<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\client\Investor */

$this->title = $model->reference_number . ' ' . $model->reference_number;
$this->params['breadcrumbs'][] = ['label' => 'Investors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['investment_id'] = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="investor-view">


    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'reference_number',
            [
                'attribute' => 'amount_to_invest',
                'value' => function($data) {
                    return number_format($data->amount_to_invest);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'investment_duration',
                'value' => function($data) {
                    return number_format($data->investment_duration);
                },
                'format' => 'raw'
            ],
            'payment_frequency',
            'interest_rate',
            'proof_of_investment',
        //'status',
        //'created_by',
        //'updated_at',
        //'updated_by',
        ],
    ])
    ?>

</div>


