<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\report\OverduePayments */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Overdue Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="overdue-payments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'description',
            'entry_reference',
            'amount',
            'debit_account',
            'credit_account',
            'due_date',
            'entry_type',
            'entry_reference_id',
            'stage',
            'created_at',
            'created_by',
            'member_account',
            'entry_period',
            'updated_at',
            'updated_by',
            'ledger_status',
            'interest_status',
            'cancel_interest_reason',
            'payment_ref',
        ],
    ]) ?>

</div>
