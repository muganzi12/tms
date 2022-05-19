<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\client\ChartOfAccounts;
use common\models\client\LoanProduct;

/* @var $this yii\web\View */
/* @var $model common\models\client\Investment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="investment-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>
            <td> <?= $form->field($model, 'amount_to_invest')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>
            <td>  
                <?= $form->field($model, 'payment_frequency')->dropDownList(['WEEKLY' => 'WEEKLY', 'MONTHLY' => 'MONTHLY', 'ANNUALLY' => 'ANNUALLY'], ['prompt' => 'Select.....']) ?>
            </td>


        </tr>

        <tr>
            <td><?= $form->field($model, 'investment_duration')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>
            <td><?= $form->field($model, 'interest_rate')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>

        </tr>
        
        <tr>
            <td colspan="6"> 
                <?= $form->field($model, 'proof_of_investment')->fileInput() ?>
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
                <?= $form->field($model, 'investor_id')->hiddenInput()->label(false) ?>
                 <?= $form->field($model, 'loan_type')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'reference_number')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>

