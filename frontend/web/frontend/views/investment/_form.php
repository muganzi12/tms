<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\client\Investment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="investment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'investor_id')->textInput() ?>

    <?= $form->field($model, 'loan_product')->textInput() ?>

    <?= $form->field($model, 'account_to_credit')->textInput() ?>

    <?= $form->field($model, 'account_to_debit')->textInput() ?>

    <?= $form->field($model, 'amount_to_invest')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'investment_duration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interest_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_interest')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expected_total_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
