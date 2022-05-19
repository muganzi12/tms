<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
?>
<div class="ledger-transaction-config-form">
    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>
            <td colspan="6">
                <?php echo $form->field($model, 'transaction_name')->textInput(['maxlength' => true]); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $form->field($model, 'is_primary')->dropDownList(['1' => 'Yes', '0' => 'No'], ['prompt' => 'Select.....']) ?>
            </td>
            <td>
                <?= $form->field($model, 'parent_id')->dropDownList(['1' => 'Yes', '0' => 'No'], ['prompt' => 'Select.....']) ?>
            </td>
            <td>
                <?php
                echo $form->field($model, 'debit_account')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($chartofaccounts, 'gl_code', 'fullAccountName', 'type.name'),
                    'options' => [
                        'placeholder' => 'Select Debit Account',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required' => true,
                    ],
                ]);
                ?>
            </td>
        </tr>
        <tr>

            <td>
                <?php
                echo $form->field($model, 'credit_account')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($chartofaccounts, 'gl_code', 'fullAccountName', 'type.name'),
                    'options' => [
                        'placeholder' => 'Select Credit Account',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required' => true,
                    ],
                ]);
                ?>
            </td>
            <td>
                <?php echo $form->field($model, 'tags')->dropDownList(['application' => 'Application', 'insurance' => 'Insurance', 'interest' => 'Interest', 'disbursement' => 'Disbursement', 'principal' => 'Principal', 'penalty' => 'Penalty'], ['prompt' => '']); ?>
            </td>

            <td>
                <?php echo $form->field($model, 'amount_rule')->dropDownList(['FLEXIBLE' => 'FLEXIBLE', 'FIXED' => 'FIXED', 'PERCENTAGE' => 'PERCENTAGE'], ['prompt' => '']); ?>
            </td>
        </tr>

        <tr>

            <td>
                <?php echo $form->field($model, 'amount')->textInput(['maxlength' => true]); ?>
            </td>
            <td>
                <?php
                echo $form->field($model, 'label_id')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($label, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Label',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required' => true
                    ],
                ]);
                ?>
            </td>
            <td>
                <?= $form->field($model, 'attracts_penalty')->dropDownList(['1' => 'Yes', '0' => 'No'], ['prompt' => 'Select.....']) ?>
            </td>
        </tr>
        <tr>


        </tr>
        <tr>
            <td colspan='6'>
                <?php echo $form->field($model, 'description')->textArea(['rows' => 2]); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo Html::submitButton('Save', ['class' => 'btn btn-success btn-block']); ?>
            </td>
            <td>
                <?php echo $form->field($model, 'created_at')->hiddenInput()->label(false); ?>
                <?php echo $form->field($model, 'product_type')->hiddenInput()->label(false); ?>
                <?php echo $form->field($model, 'product_id')->hiddenInput()->label(false); ?>
                <?php echo $form->field($model, 'created_by')->hiddenInput()->label(false); ?>
                <?php echo $form->field($model, 'updated_by')->hiddenInput()->label(false); ?>
                <?php echo $form->field($model, 'updated_at')->hiddenInput()->label(false); ?>
            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>
</div>
