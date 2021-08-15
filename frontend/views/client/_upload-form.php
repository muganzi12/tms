<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\client\MemberDocuments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-documents-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <table class="table">
        <tr>
            <td>   <?= $form->field($model, 'name')->textInput() ?>
            </td>
            <td> <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            </td>

        </tr>

        <tr>
            <td colspan="6">
                <?= $form->field($model, 'file_name')->fileInput() ?> 
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
                <?= $form->field($model, 'client_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>

