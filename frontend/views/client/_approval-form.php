<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanManagerRemarks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-manager-remarks-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>

            <td colspan="6">
                <?= $form->field($model, 'remarks')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50,'required'=>true]) ?>
            </td>
        </tr>

        <tr>
            <td colspan="6">
                <?= Html::submitButton(($model->id > 0) ? ('Update') : ('Approve'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-success'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">

                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'category')->hiddenInput()->label(false) ?>
                 <?= $form->field($model, 'remarks_status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'client_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>
