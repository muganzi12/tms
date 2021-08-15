<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\client\Branch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branch-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>
            <td>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
            <td>
                <?= $form->field($model, 'mobile_telephone')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
            <td>
                <?= $form->field($model, 'office_telephone')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
        </tr>

        <tr>
            <td colspan="6">
                <?= $form->field($model, 'address')->textInput(['maxlength' => true,'required'=>true]) ?>

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
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

    </div>
