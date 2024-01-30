<?php

use common\models\property\Property;
use common\models\property\PropertyType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\property\PropertyUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-unit-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'unit_number')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'property')->widget(Select2::classname(), [
    'value' => '',
    'theme' => Select2::THEME_CLASSIC,
    'data' => ArrayHelper::map(Property::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
    'options' => [
        'placeholder' => 'Select Property',
        'class' => 'form-control',
        'multiple' => false,
        'required' => true,
    ],
]);
?>

    <?=$form->field($model, 'number_of_rooms')->textInput()?>

    <?=$form->field($model, 'unit_type')->widget(Select2::classname(), [
    'value' => '',
    'theme' => Select2::THEME_CLASSIC,
    'data' => ArrayHelper::map(PropertyType::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
    'options' => [
        'placeholder' => 'Select Unit Type',
        'class' => 'form-control',
        'multiple' => false,
        'required' => true,
    ],
]);
?>

<?=$form->field($model, 'floor')->widget(Select2::classname(), [
    'value' => '',
    'theme' => Select2::THEME_CLASSIC,
    'data' => ArrayHelper::map(PropertyType::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
    'options' => [
        'placeholder' => 'Select Floor',
        'class' => 'form-control',
        'multiple' => false,
        'required' => true,
    ],
]);
?>
    <?=$form->field($model, 'rate')->textInput()?>

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
