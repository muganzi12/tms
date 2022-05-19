<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\User;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\client\LoanManagerRemarks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-manager-remarks-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>

            <td colspan="12">
                <?= $form->field($model, 'remarks')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50,'required'=>true]) ?>
            </td>
        </tr>
        <tr>
            <td>
         
                
                         <?php
                echo $form->field($model, 'submitted_to')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                     'data' => ArrayHelper::map(User::find()->where(['office_id' =>3])->all(), 'id', 'fullNames'),
                    'options' => [
                        'placeholder' => 'Select Director',
                        'class' => 'form-control',
                        //'id' => 'user-outlet-id',
                        'multiple' => false,
                        'required' => true
                    ]
                ]);
                ?> 
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <?= Html::submitButton(($model->id > 0) ? ('Update') : ('Submit'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">

                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'category')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'loan_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'client_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'remarks_status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>
