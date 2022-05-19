<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reference_number') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'loan_type') ?>

    <?= $form->field($model, 'amount_applied_for') ?>

    <?php // echo $form->field($model, 'amount_approved') ?>

    <?php // echo $form->field($model, 'application_date') ?>

    <?php // echo $form->field($model, 'disbursment_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'interest_rate') ?>

    <?php // echo $form->field($model, 'interest_frequency') ?>

    <?php // echo $form->field($model, 'installment_frequency') ?>

    <?php // echo $form->field($model, 'payment_installment_amount') ?>

    <?php // echo $form->field($model, 'installment_payment_start_date') ?>

    <?php // echo $form->field($model, 'installment_payment_last_date') ?>

    <?php // echo $form->field($model, 'interest_payment_start_date') ?>

    <?php // echo $form->field($model, 'interest_payment_last_date') ?>

    <?php // echo $form->field($model, 'loan_period') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
