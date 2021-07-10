<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\sacco\Sacco */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sacco-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>
     
            <td>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </td>
            <td>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            </td>
            <td>
                <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

            </td>


        </tr>
        <tr>
            <td>
                <?= $form->field($model, 'brn')->textInput() ?>
            </td>
          
            <td>
                <?= $form->field($model, 'certificate_no')->textInput(['maxlength' => true]) ?>
            </td>
            <td>

                <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

            </td>

        </tr>
        <tr>

            <td colspan="6">
                <?= $form->field($model, 'address')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50]) ?>
            </td>
        </tr>

        <tr>
            <td>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </td>
            <td colspan="2">
                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>

            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>
