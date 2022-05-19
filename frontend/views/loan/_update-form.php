<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use common\models\client\Branch;

$new_link = "user/new-admin";
$update_link = "user/update";
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>

            <td colspan="6">
                <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?> 
            </td>


        </tr>
        
        
             <tr>

              <td colspan="12">
                <?= $form->field($model, 'cancel_interest_reason')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50, 'required' => true]) ?>
            </td>


        </tr>



        <tr>

            <td></td><td></td>
            <td>
                <?= $form->field($model, 'id')->hiddenInput()->label(false); ?> 
                <?= $form->field($model, 'description')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'entry_reference')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'debit_account')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'credit_account')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'due_date')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'entry_type')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'entry_reference_id')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'member_account')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'entry_period')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'ledger_status')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'interest_status')->hiddenInput()->label(false) ?>


            </td>
        </tr>

        <tr>
            <td>
                <?= Html::submitButton(($model->id > 0) ? ('Update') : ('Save'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="3"></td>
        </tr>
    </table>


    <div class="form-group">

    </div>

    <?php ActiveForm::end(); ?>

</div>
