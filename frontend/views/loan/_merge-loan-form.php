<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\client\LoanProduct;
use yii\jui\DatePicker;
use common\models\ReferenceHelper;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */
/* @var $form yii\widgets\ActiveForm */
$principal = ReferenceHelper::getTotalPrincipalPaid($_GET['id']);
?>

<div class="loan-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>

            <td>  <?= $form->field($model, 'reference_number')->textInput(['readonly' => true]) ?> </td>
            <td>  <?= $form->field($model, 'balance')->textInput(['readonly' => true]) ?> </td>
            <td>  <?= $form->field($model, 'top_up_amount')->textInput(['required' => true]) ?></td>
          

        </tr>
 

        <tr>
              
            <td>  <?= $form->field($model, 'amount_applied_for')->textInput(['required' => true]) ?></td>
            <td>

                <?php
                echo $form->field($model, 'installment_frequency')->dropDownList(['MONTHLY' => 'MONTHLY', 'WEEKLY' => 'WEEKLY', 'BI-WEEKLY' => 'BI-WEEKLY'], ['prompt' => 'Select Option', 'required' => true]);
                ?>
            </td>
     
            <td>

                <?= $form->field($model, 'loan_period')->textInput(['required' => true]) ?>

            </td>

        </tr>

        <tr>
            
            <td> 

                <?= $form->field($model, 'interest_rate')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>
            <td> 
                <?php
                echo $form->field($model, 'interest_frequency')->dropDownList(['WEEKLY' => 'WEEKLY', 'BI-WEEKLY' => 'BI-WEEKLY'], ['prompt' => 'Select Option', 'required' => true]);
                ?>

            </td>
            <td>

                <?=
                $form->field($model, 'application_date')->widget(
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
                            'options' => ['class' => 'form-control', 'placeholder' => '01-01-2022', 'required' => true]
                ])
                ?>

            </td>


        </tr>

        <tr>
            <td colspan="6">

                <?php
                echo $form->field($model, 'loan_product')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($type, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Loan Type',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required' => true
                    ],
                ]);
                ?>
            </td>
        </tr>



        <tr>
            <td>
                <?= Html::submitButton(($model->id > 0) ? ('Update') : ('Submit'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">

                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'client_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'amortization_method')->hiddenInput()->label(false) ?>
                  <?= $form->field($model, 'loan_type')->hiddenInput()->label(false) ?>
                 <?= $form->field($model, 'currency')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<<EOD
$(function() {
     $('#loan-balance').keyup(function() {  
        updateTotal();
    });

    $('#loan-top_up_amount').keyup(function() {  
        updateTotal();
    });

    var updateTotal = function () {
      var input1 = parseInt($('#loan-balance').val());
      var input2 = parseInt($('#loan-top_up_amount').val());
    $('#loan-amount_applied_for').val(input1 + input2);
    };
        
   var updateTotal = function () {
    var doctorFee = parseInt($('#loan-balance').val());
    var discount = parseInt($('#loan-top_up_amount').val());
    var totalAmount = doctorFee + discount;

    if (isNaN(totalAmount) || totalAmount < 0) {
        totalAmount = '';
    }

    $('#loan-amount_applied_for').val(totalAmount);
};

 });

EOD;
$this->registerJs($script);
?>

<pre>
    <?php print_r($principal); ?>
</pre>
