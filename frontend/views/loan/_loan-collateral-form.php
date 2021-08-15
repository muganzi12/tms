<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanCollateral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-collateral-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <table class="table">
        <tr>
            <td>
                <?php
                echo $form->field($model, 'type_of_collateral')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($type, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Type of Collateral',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required' => true
                    ],
                ]);
                ?>
            </td>
            <td>
                <?= $form->field($model, 'estimated_price')->textInput(['maxlength' => true, 'required' => true]) ?>

            </td>

        </tr>
        <tr>

            <td>

                <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'required' => true]) ?>


            </td>
            <td colspan="4">

                <?= $form->field($model, 'location')->textInput(['maxlength' => true, 'required' => true]) ?>

            </td>
        </tr>
        <tr>
            <td colspan="6">
                <?= $form->field($model, 'proof_of_ownership')->fileInput() ?> 

            </td>
        </tr>

        <tr>
            <td>
                <?= Html::submitButton(($model->id > 0) ? ('Update') : ('Upload'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
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