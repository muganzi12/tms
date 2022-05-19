<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\client\LoanCollateral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-collateral-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <table class="table">
    <tr>
        <td style="width:33%">
                 <?=
                $form->field($model, 'payment_date')->widget(
                        DatePicker::class,
                        [
                            'dateFormat' => 'dd-MM-yyyy',
                            'clientOptions' => [
                                'changeMonth' => false,
                                'changeYear' => true,
                                'minDate' => '-100y',
                                'maxDate' => '0',
                                'showButtonPanel' => false,
                                'todayHighlight' => false,
                                'format' => 'Y-m-d',
                            //'yearRange' => '1990:2020'
                            ],
                            'options' => ['class' => 'form-control', 'readonly' => 'readonly', 'required' => true]
                ])
                ?>
        </td>
        <td style="width:34%;">
                <?= $form->field($model, 'paid_by')->textInput(['maxlength' => true]) ?>
        </td>
        <td> 
                <?= $form->field($model, 'amount_paid')->textInput(['maxlength' => true]) ?>
        </td>
    </tr>
    <tr>
          <td style="width:33%">
                 <?= $form->field($model, 'payment_method')->dropdownList(
                    ArrayHelper::map($payment_methods,'id','name'),
                    ['prompt'=>'Select Method']
                ) ?> 
        </td>
        <td>
          
        </td>
        
               <td> 
                <?= $form->field($model, 'proof_attachment')->fileInput() ?>
        </td>
 
    </tr>
    <tr>
        <td colspan="3">
                <?= $form->field($model, 'description')->textArea(['rows'=>2]) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= Html::submitButton('Record Payment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:30px;']) ?>
        </td>
          <td colspan="2">
             <?= $form->field($model, 'loan_id')->hiddenInput()->label(false) ?> 
              <?= $form->field($model, 'reference_no')->hiddenInput()->label(false) ?>
              <?= $form->field($model, 'transaction_type')->hiddenInput()->label(false) ?> 
              <?= $form->field($model, 'debit_account')->hiddenInput()->label(false) ?> 
        </td>
    </tr>
    </table>
<?php ActiveForm::end(); ?>

</div>