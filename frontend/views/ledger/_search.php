<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\loan\LedgerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ledger-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'entry_reference') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'debit_account') ?>

    <?php // echo $form->field($model, 'credit_account') ?>

    <?php // echo $form->field($model, 'due_date') ?>

    <?php // echo $form->field($model, 'entry_type') ?>

    <?php // echo $form->field($model, 'entry_reference_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'member_account') ?>

    <?php // echo $form->field($model, 'entry_period') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'ledger_status') ?>

    <?php // echo $form->field($model, 'interest_status') ?>

    <?php // echo $form->field($model, 'payment_ref') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
