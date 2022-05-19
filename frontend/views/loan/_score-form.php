<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\client\LoanProduct;
use yii\jui\DatePicker;
$update_link="loan/rate-client";
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-form">
     <?php $form = ActiveForm::begin(['action'=>Url::to([($activity=="update_record")?($update_link):($new_link),'id'=>$model->loan_id])]); ?>
  
    <table class="table">
        <tr>
   
           <td colspan="6"> 
                
                 <?php
                echo $form->field($model, 'guadge_score_id')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map(\common\models\loan\Guadge::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Rate',
                        'class' => 'form-control',
                        //'id' => 'user-outlet-id',
                        'multiple' => false
                    ]
                ]);
                ?>
            </td>
    
        </tr>

        <tr>
            
        
            <td colspan="6"> 
                <?= $form->field($model, 'reason')
                ->textArea(['maxlength' => true, 'required' => true])
                ->label('Reason') ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= Html::submitButton(($model->id > 0) ? ('Score') : ('Submit'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">
                <?= $form->field($model, 'client_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'loan_id')->hiddenInput()->label(false) ?>
                 <?= $form->field($model,'rate_item_id')->hiddenInput()->label(false) ?>
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
      var input1 = parseInt($('#score-rate_item_id-container').val());
      var input2 = parseInt($('#score-guadge_score_id-container').val());
    $('#score-mark').val(input1 + input2);
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

