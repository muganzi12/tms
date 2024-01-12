<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\account\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'type')->textInput()?>

    <?=$form->field($model, 'description')->textarea(['rows' => 6])?>

    <?=$form->field($model, 'rule_name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'data')->textInput()?>

    <?=$form->field($model, 'created_at')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'updated_at')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'module')->textInput(['maxlength' => true])?>

    <div class="form-group">
    <?=Html::submitButton(($model->id > 0) ? ('Update') : ('Save'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
