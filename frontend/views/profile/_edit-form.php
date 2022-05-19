<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\master\How2KnowEoc;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

//Dropdowns
/*
 * Form to edit details of the logged in User
 */
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-lg-4">
        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'alt_email')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'profile_pic')->fileInput() ?>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('Update profile', ['class' => 'btn btn-success']) ?>
</div>
<?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'created_at')->hiddenInput()->label(false);
; ?>
<?= $form->field($model, 'office_id')->hiddenInput()->label(false);
; ?> 
<?php ActiveForm::end(); ?>
