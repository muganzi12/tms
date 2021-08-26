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


            <td> 

                <?= $form->field($model, 'amount_approved')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>


            <td> 

                <?php
                echo $form->field($model, 'amortization_method')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($method, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Amortization Method',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required' => true
                    ],
                ]);
                ?>

            </td>

            <td>
                <?=
                $form->field($model, 'installment_payment_start_date')->widget(
                        DatePicker::class,
                        [
                            'dateFormat' => 'yyyy-MM-dd',
                            'clientOptions' => [
                                'changeMonth' => false,
                                'changeYear' => true,
                                'minDate' => '0y',
                                //'maxDate' => '0',
                                'showButtonPanel' => false,
                                'todayHighlight' => false,
                                'format' => 'Y-m-d',
                            //'yearRange' => '1990:2020'
                            ],
                            'options' => ['class' => 'form-control','required' => true]
                ])
                ?>

            </td>
        </tr>
        <tr>
            <td>
                <?=
                $form->field($model, 'installment_payment_last_date')->widget(
                        DatePicker::class,
                        [
                            'dateFormat' => 'yyyy-MM-dd',
                            'clientOptions' => [
                                'changeMonth' => false,
                                'changeYear' => true,
                                'minDate' => '0y',
                                // 'maxDate' => '0',
                                'showButtonPanel' => false,
                                'todayHighlight' => false,
                                'format' => 'Y-m-d',
                            //'yearRange' => '1990:2020'
                            ],
                            'options' => ['class' => 'form-control', 'required' => true]
                ])
                ?>

            </td>
            <td>
                <?=
                $form->field($model, 'interest_payment_start_date')->widget(
                        DatePicker::class,
                        [
                            'dateFormat' => 'yyyy-MM-dd',
                            'clientOptions' => [
                                'changeMonth' => false,
                                'changeYear' => true,
                                'minDate' => '0y',
                                //'maxDate' => '0',
                                'showButtonPanel' => false,
                                'todayHighlight' => false,
                                'format' => 'Y-m-d',
                            //'yearRange' => '1990:2020'
                            ],
                            'options' => ['class' => 'form-control', 'required' => true]
                ])
                ?>

            </td>
            <td>
                <?=
                $form->field($model, 'interest_payment_last_date')->widget(
                        DatePicker::class,
                        [
                            'dateFormat' => 'yyyy-MM-dd',
                            'clientOptions' => [
                                'changeMonth' => false,
                                'changeYear' => true,
                                'minDate' => '0y',
                                //'maxDate' => '0',
                                'showButtonPanel' => false,
                                'todayHighlight' => false,
                                'format' => 'Y-m-d',
                            //'yearRange' => '1990:2020'
                            ],
                            'options' => ['class' => 'form-control','required' => true]
                ])
                ?>

            </td>
        </tr>

        <tr>
            <td>

                <?=
                $form->field($model, 'payment_installment_amount')->dropDownList([]) ?>

            </td> 
            <td colspan="6"> 

                <?= $form->field($model, 'remarks')->textArea(['maxlength' => true, 'required' => true]) ?>
            </td>
        </tr>


        <tr>
            <td>
                <?= Html::submitButton(($model->id > 0) ? ('Approve') : ('Submit'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">

                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'approved_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'approved_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'client_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'loan_type')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'reference_number')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'amount_applied_for')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'interest_rate')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'interest_frequency')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'application_date')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'installment_frequency')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'loan_period')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
// here you right all your javascript stuff
$(document).on("change", '#loan-amount_approved',function(){
   var e = document.getElementById('loan-amount_approved');
        //alert(e);
   var amount = e.value; 
        //alert(quant);
   var princ = amount/3;
       // alert(princ);
       var tot='';
       tot += '<option >'+princ+'</option>';
       $('#loan-payment_installment_amount').html(tot); 
        
  
   });
        
JS;
$this->registerJs($script);
?>


