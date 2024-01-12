<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\property\MaintenanceRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maintenance-request-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'property_id')->textInput()?>

    <?=$form->field($model, 'unit')->textInput()?>

    <?=$form->field($model, 'request_date')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'maintainer')->textInput()?>

    <?=$form->field($model, 'issue_type')->textInput()?>

    <?=$form->field($model, 'attachment')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'notes')->textarea(['rows' => 6])?>
    <?=$form->field($model, 'status')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'created_at')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'created_by')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'updated_at')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'updated_by')->hiddenInput()->label(false)?>

    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
