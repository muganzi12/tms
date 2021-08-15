<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'interest_rate') ?>

    <?= $form->field($model, 'account_to_credit') ?>

    <?php // echo $form->field($model, 'account_to_debit') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'processing_loan_fees') ?>

    <?php // echo $form->field($model, 'minimum_amount') ?>

    <?php // echo $form->field($model, 'maximum_amount') ?>

    <?php // echo $form->field($model, 'maximum_repayment_period') ?>

    <?php // echo $form->field($model, 'number_of_installments') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'penalty') ?>

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
