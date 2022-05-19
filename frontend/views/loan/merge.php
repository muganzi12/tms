<?php
use yii\helpers\Html;
use common\models\client\LoanAmortization;
use common\models\loan\LedgerTransactionConfig;
use common\models\loan\LedgerHelper;
use nullref\datatable\DataTable;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\select2\Select2;
use common\models\ReferenceHelper;
$principal = ReferenceHelper::getTotalBalance($_GET['ledger']);

$this->title = $model->reference_number.' - Merge';
//Pass CLientID to the layout 
$this->params['client_id'] = $clientId;
?>


<div class="loan-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>

            <td>  <?= $form->field($model, 'reference_number')->textInput(['readonly' => true]) ?> </td>
          
           <td>  <?= $form->field($model, 'amount_applied_for')->textInput(['required' => true,'readonly' => true]) ?></td>
                 <td>

                <?php
                echo $form->field($model, 'installment_frequency')->dropDownList(['MONTHLY' => 'MONTHLY', 'WEEKLY' => 'WEEKLY', 'BI-WEEKLY' => 'BI-WEEKLY'], ['prompt' => 'Select Option', 'required' => true]);
                ?>
            </td>
        </tr>
 

        <tr>
              
 
      
     
            <td>

                <?= $form->field($model, 'loan_period')->textInput(['required' => true]) ?>

            </td>
                  <td> 

                <?= $form->field($model, 'interest_rate')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>
            <td> 
                <?php
                echo $form->field($model, 'interest_frequency')->dropDownList(['WEEKLY' => 'WEEKLY', 'BI-WEEKLY' => 'BI-WEEKLY'], ['prompt' => 'Select Option', 'required' => true]);
                ?>

            </td>

        </tr>

        <tr>
            
      
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
    $('#loan-amount_applied_for').val(input1);
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
