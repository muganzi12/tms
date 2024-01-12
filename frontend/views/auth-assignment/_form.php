<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\account\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'item_name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'user_id')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'created_at')->hiddenInput()->label(false)?>

    <div class="form-group">
    <?=Html::submitButton(($model->id > 0) ? ('Update') : ('Save'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
