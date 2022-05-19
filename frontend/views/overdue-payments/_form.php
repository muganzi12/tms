<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\report\OverduePayments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="overdue-payments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entry_reference')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'debit_account')->textInput() ?>

    <?= $form->field($model, 'credit_account')->textInput() ?>

    <?= $form->field($model, 'due_date')->textInput() ?>

    <?= $form->field($model, 'entry_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entry_reference_id')->textInput() ?>

    <?= $form->field($model, 'stage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'member_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entry_period')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'ledger_status')->textInput() ?>

    <?= $form->field($model, 'interest_status')->textInput() ?>

    <?= $form->field($model, 'cancel_interest_reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_ref')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
