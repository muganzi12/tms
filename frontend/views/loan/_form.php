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
                <?php
                echo $form->field($model, 'loan_type')->widget(Select2::classname(), [
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
            <td>  <?= $form->field($model, 'reference_number')->textInput(['readonly' => true]) ?> </td>

            <td>      <?= $form->field($model, 'amount_applied_for')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>

        </tr>
        <tr>
            <td>

                <?php
                echo $form->field($model, 'currency')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($currency, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Currencyu',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required' => true
                    ],
                ]);
                ?>
            </td>
            <td>

                <?= $form->field($model, 'installment_frequency')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>
            <td>

                <?= $form->field($model, 'loan_period')->textInput(['required' => true]) ?>

            </td>

        </tr>
        <tr>


            <td> 

                <?= $form->field($model, 'interest_rate')->textInput(['maxlength' => true, 'required' => true]) ?>
            </td>


            <td>  <?= $form->field($model, 'interest_frequency')->textInput(['maxlength' => true, 'required' => true]) ?>

            </td>

            <td>

                <?=
                $form->field($model, 'application_date')->widget(
                        DatePicker::class,
                        [
                            'dateFormat' => 'yyyy-MM-dd',
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
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
// here you right all your javascript stuff

$('#productId').change(function(){
	var prodId = $(this).val();
	$.get('index.php?r=loan-product/get-interest-rate',{ prodId : prodId },function(data){
		var data = $.parseJSON(data);
		$('#loan-installment_frequency').attr('value',data.principal_installment_frequency);
		$('#loan-interest_rate').attr('value',data.interest_rate);
                $('#loan-interest_frequency').attr('value',data.interest_frequency);
                $('#loan-loan_period').attr('value',data.maximum_repayment_period*30);
                $('#loan-reference_number').attr('value',data.product_code + Math.floor((Math.random() *100000000000) + 1));
   
	});
});
JS;
$this->registerJs($script);
?>
