<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\client\ChartOfAccounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chart-of-accounts-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>
            <td><?= $form->field($model, 'gl_code')->textInput() ?></td>
            <td> <?= $form->field($model, 'account_name')->textInput(['maxlength' => true]) ?></td>
            <td>
                <?php
                echo $form->field($model, 'account_type')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($type, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Account Type',
                        'class' => 'form-control',
                        'multiple' => false
                    ],
                ]);
                ?>

            </td>
        </tr>



        <tr>

            <td colspan="6">
                <?= $form->field($model, 'description')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50]) ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= Html::submitButton(($model->id > 0) ? ('Update') : ('Save'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">

                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                 <?= $form->field($model, 'category')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>
