<?php

use common\models\location\District;
use common\models\location\Division;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\location\Parish */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parish-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'municipality')->widget(Select2::classname(), [
    'value' => '',
    'theme' => Select2::THEME_CLASSIC,
    'data' => ArrayHelper::map(District::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
    'options' => [
        'placeholder' => 'Select Municipality',
        'class' => 'form-control',
        'multiple' => false,
        'required' => true,
    ],
]);
?>
  <?=$form->field($model, 'division')->widget(Select2::classname(), [
    'value' => '',
    'theme' => Select2::THEME_CLASSIC,
    'data' => ArrayHelper::map(Division::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
    'options' => [
        'placeholder' => 'Select Division',
        'class' => 'form-control',
        'multiple' => false,
        'required' => true,
    ],
]);
?>


    <?=$form->field($model, 'created_at')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'created_by')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'updated_at')->hiddenInput()->label(false)?>

    <?=$form->field($model, 'updated_by')->hiddenInput()->label(false)?>

    <div class="form-group">
    <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
