<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\location\District */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="district-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'created_at')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'created_by')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'updated_at')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'updated_by')->hiddenInput()->label(false)?>

    <div class="form-group">
    <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save this Application') : Yii::t('app', 'Update'), ['class' => 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
