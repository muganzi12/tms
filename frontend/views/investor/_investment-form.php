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
                <?= $form->field($model, 'duration_type')->dropDownList(['Weekly' => 'Weekly','Monthly' => 'Monthly','Annually' => 'Annually'], ['prompt' => 'Select.....']) ?>
            </td>
            <td><?= $form->field($model, 'investment_duration')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>
            <td><?= $form->field($model, 'interest_rate')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>

        </tr>

        <tr>
            <td> 
                <?php
                echo $form->field($model, 'loan_product')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map(LoanProduct::find()->select(['id', 'name'])->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select a Header ', 'id' => 'productId',
                        'class' => 'form-control',
                        //'id' => 'user-outlet-id',
                        'multiple' => false,
                        'required' => true
                    ]
                ]);
                ?> 

            </td>

            <td> <?= $form->field($model, 'total_interest')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>
            <td colspan="4"> <?= $form->field($model, 'expected_total_amount')->textInput(['maxlength' => true, 'required' => true]) ?></td>
            <td></td>

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
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>

