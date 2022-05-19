<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\client\LoanProduct;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-form">
    <?php $form = ActiveForm::begin(); ?>
  
    <table class="table">
        <tr>
   
           <td colspan="6"> 
                
                   <?php
                echo $form->field($model, 'rate')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($member, 'name', 'name'),
                    'options' => [
                        'placeholder' => 'Yes/No',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required'=>true
                    ],
                ]);
                ?>
            </td>
    
        </tr>

        <tr>
            <td>
                <?= Html::submitButton(($model->id > 0) ? ('Mark') : ('Submit'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">
                <?= $form->field($model, 'client_id')->hiddenInput()->label(false) ?>
                 <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'loan_id')->hiddenInput()->label(false) ?>
                 <?= $form->field($model,'requirement_id')->hiddenInput()->label(false) ?>
            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>
