<?php

use common\models\location\District;
use common\models\location\Division;
use common\models\location\Parish;
use common\models\location\Street;
use common\models\location\Village;
use common\models\property\PropertyType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\property\Property */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-form">

    <?php $form = ActiveForm::begin();?>
    <table class="table">

                <div class ="row">
                <div class="col-sm-12">
        <h5><b>SECTION A –  PROPERTY  DETAILS</b></h5>
</div>
                    <div class="col-sm-6">
                    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>
                </div>
                <div class="col-sm-6">

                <?=$form->field($model, 'type')->widget(Select2::classname(), [
    'value' => '',
    'theme' => Select2::THEME_CLASSIC,
    'data' => ArrayHelper::map(PropertyType::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
    'options' => [
        'placeholder' => 'Select Property Unit',
        'class' => 'form-control',
        'multiple' => false,
        'required' => true,
    ],
]);
?>
                </div>
        </div>

            <div class= "row">

                <div class="col-sm-12">
                <?=$form->field($model, 'description')->textarea(['rows' => 6])?>
          </div>
</div>

        <div class= "row">
        <div class="col-sm-12">
        <h5><b>SECTION B –  PROPERTY LOCATION DETAILS</b></h5>
</div>
                <div class="col-sm-6">

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
          </div>
          <div class="col-sm-6">
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
           </div>
</div>

<div class= "row">
                <div class="col-sm-6">

                <?=$form->field($model, 'parish')->widget(Select2::classname(), [
    'value' => '',
    'theme' => Select2::THEME_CLASSIC,
    'data' => ArrayHelper::map(Parish::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
    'options' => [
        'placeholder' => 'Select Parish',
        'class' => 'form-control',
        'multiple' => false,
        'required' => true,
    ],
]);
?>
</div>
<div class="col-sm-6">
            <?=$form->field($model, 'village')->widget(Select2::classname(), [
    'value' => '',
    'theme' => Select2::THEME_CLASSIC,
    'data' => ArrayHelper::map(Village::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
    'options' => [
        'placeholder' => 'Select Village',
        'class' => 'form-control',
        'multiple' => false,
        'required' => true,
    ],
]);
?>
</div>
</div>

<div class= "row">
                <div class="col-sm-6">
                <?=$form->field($model, 'street')->widget(Select2::classname(), [
    'value' => '',
    'theme' => Select2::THEME_CLASSIC,
    'data' => ArrayHelper::map(Street::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
    'options' => [
        'placeholder' => 'Select Street',
        'class' => 'form-control',
        'multiple' => false,
        'required' => true,
    ],
]);
?>
</div>
<div class="col-sm-6">
            <?=$form->field($model, 'plot_number')->textInput(['maxlength' => true])?>
</div>
</div>


<div class= "row">
                <div class="col-sm-6">
                <?=$form->field($model, 'house_number')->textInput()?>
</div>
            <div class= "col-sm-6">
<?=$form->field($model, 'attachment')->textInput(['maxlength' => true])?>
</div>
</div>


    <div class="form-group">
    <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save this Application') : Yii::t('app', 'Update'), ['class' => 'btn btn-primary'])?>
    </div>


                <?=$form->field($model, 'created_by')->hiddenInput()->label(false)?>
                <?=$form->field($model, 'created_at')->hiddenInput()->label(false)?>
                <?=$form->field($model, 'updated_at')->hiddenInput()->label(false)?>
                <?=$form->field($model, 'updated_by')->hiddenInput()->label(false)?>
                <?=$form->field($model, 'status')->hiddenInput()->label(false)?>
                <?=$form->field($model, 'id')->hiddenInput()->label(false)?>



</table>

    <?php ActiveForm::end();?>

</div>
