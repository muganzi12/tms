<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\client\LoanGuarantor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-guarantor-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>

            <td>
                <?= $form->field($model, 'firstname')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
            <td>
                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
            <td>
                <?= $form->field($model, 'othername')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
         
        </tr>
        <tr>
                        <td>

                <?php
                echo $form->field($model, 'gender')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($sex, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Gender',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required'=>true
                    ],
                ]);
                ?>
            </td>
          
            <td>
                <?php
                echo $form->field($model, 'identification_type')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($ident, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Identification Type',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required'=>true
                    ],
                ]);
                ?>
            </td>
            <td>
                <?= $form->field($model, 'identification_number')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
        <tr>
                  <td>
                <?= $form->field($model, 'telephone_primary')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
            <td>
                <?= $form->field($model, 'telephone_alternative')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
            
              <td>
                <?= $form->field($model, 'source_of_income')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
        </tr>
        </tr>

        <tr>
            <td colspan="6">
                <?= $form->field($model, 'physical_address')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50,'required'=>true]) ?>
            </td>
        </tr>

        <tr>
            <td>
                <?= Html::submitButton(($model->id > 0) ? ('Update') : ('Submit'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">

                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'loan_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>