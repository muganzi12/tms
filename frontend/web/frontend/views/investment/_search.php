<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\client\InvestmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="investment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'investor_id') ?>

    <?= $form->field($model, 'loan_product') ?>

    <?= $form->field($model, 'account_to_credit') ?>

    <?= $form->field($model, 'account_to_debit') ?>

    <?php // echo $form->field($model, 'amount_to_invest') ?>

    <?php // echo $form->field($model, 'investment_duration') ?>

    <?php // echo $form->field($model, 'interest_rate') ?>

    <?php // echo $form->field($model, 'total_interest') ?>

    <?php // echo $form->field($model, 'expected_total_amount') ?>

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
