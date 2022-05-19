<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*
 * Form to register a new Group
 */
$this->title = "New User Group";
$this->params['page_description'] = "New User Group";
?>
<div class="usergroup-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 2]); ?>
    <?= $form->field($model, 'type')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'created_at')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'rule_name')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'data')->hiddenInput()->label(false); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>