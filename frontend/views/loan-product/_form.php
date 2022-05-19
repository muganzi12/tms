<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\client\ChartOfAccounts;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-product-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>
            <td>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>

            <td>
                <?= $form->field($model, 'product_code')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>

            <td>
                <?= $form->field($model, 'interest_rate')->textInput(['maxlength' => true, 'type' => 'number','step' => '0.01', 'required' => true]) ?>
            </td>
            <td>  
                <?= $form->field($model, 'maximum_repayment_period')->textInput(['maxlength' => true, 'type' => 'number', 'step' => '1', 'required' => true]) ?>

            </td>

        </tr>
        <tr>
   
            </td>
            <td>    <?= $form->field($model, 'minimum_amount')->textInput(['maxlength' => true, 'required' => true, 'required' => true]) ?>
            </td>
            <td>   <?= $form->field($model, 'maximum_amount')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>
            <td>  
                <?= $form->field($model, 'principal_installment_frequency')->dropDownList(['Monthly' => 'Monthly'], ['prompt' => 'Monthly']) ?>
            </td>
     <td> 
                <?= $form->field($model, 'interest_frequency')->dropDownList(['Weekly' => 'Weekly'], ['prompt' => 'Weekly']) ?>
            </td>
          
        </tr>

        <tr> 
         

            <td>
                <?= $form->field($model, 'penalty')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>

        

        </tr>

        <tr>

            <td colspan="6">
                <?= $form->field($model, 'description')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50, 'required' => true]) ?>
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

