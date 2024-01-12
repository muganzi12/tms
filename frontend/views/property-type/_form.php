<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\property\PropertyUnits */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-units-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'name')->textInput()?>


    <?=$form->field($model, 'status')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'created_at')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'created_by')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'updated_at')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'updated_by')->hiddenInput()->label(false)?>

    <div class="form-group">
    <?=Html::submitButton(($model->id > 0) ? ('Update') : ('Save'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
