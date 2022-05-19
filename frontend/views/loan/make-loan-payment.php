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

$this->title = $model->id.' - Record payment';
$this->params['schedule_id'] = $model->id;
$this->params['id'] = $model->id;
use common\models\client\Loan;



?>


<?php $form = ActiveForm::begin(); ?>
    <table class="table">
    <tr>
        <td style="width:33%">
                 <?=
                $form->field($payment, 'payment_date')->widget(
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
        <td style="width:34%;">
                <?= $form->field($payment, 'paid_by')->textInput(['maxlength' => true]) ?>
        </td>
        <td> 
                <?= $form->field($payment, 'amount_paid')->textInput(['maxlength' => true]) ?>
        </td>
    </tr>
    <tr>
          <td style="width:33%">
                 <?= $form->field($payment, 'payment_method')->dropdownList(
                    ArrayHelper::map($payment_methods,'id','name'),
                    ['prompt'=>'Select Method']
                ) ?> 
        </td>
        <td>
          
        </td>
        
               <td> 
                <?= $form->field($payment, 'proof_attachment')->fileInput() ?>
        </td>
 
    </tr>
    <tr>
        <td colspan="3">
                <?= $form->field($payment, 'description')->textArea(['rows'=>2]) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= Html::submitButton('Record Payment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:30px;']) ?>
        </td>
          <td colspan="2">
             <?= $form->field($payment, 'loan_id')->hiddenInput()->label(false) ?> 
               <?= $form->field($payment, 'schedule_id')->hiddenInput()->label(false) ?> 
             <?= $form->field($payment, 'transaction_type')->hiddenInput()->label(false) ?> 
             <?= $form->field($payment, 'debit_account')->hiddenInput()->label(false) ?> 
        </td>
    </tr>
    </table>
<?php ActiveForm::end(); ?>

<pre>
    <?php
    $prin = 4830733;
    $arr = [];
    if($prin > 0){
        for ($i=0; $i < count($schedule); $i++) { 
            # code...
            $initialAmount = $prin;
            print_r("\n\nValidate Payment installation No. ". ($i+1) ."\n");
            $interest = $schedule[$i]["interest_amount"];
            $principal = $schedule[$i]["principal_amount"];
            $principalPaid = $schedule[$i]["principal_paid"];
            $interestPaid = $schedule[$i]["interest_paid"];
            $interest > $interestPaid ? ($prin = $prin - ($interest - $interestPaid)) : $prin;
            $interestToPay = $interest - $interestPaid;
            $principalToPay = $principal - $principalPaid;
            if($prin > 0 && $interestPaid < $interest){
                ///only pay whats due
                print_r("Cleared interest of ". number_format($interestToPay) ." for this payment id ". ($i+1) ." and update the database with interest paid of : ". number_format($interest) ."\n");
                print_r("Balance to be moved to principal is :". number_format($prin)."\n");
                array_push($arr, $interestToPay);
                //save fully the initial interest
                ///clear this interest fully and move to principal
                //subtract the principal from the remaining amount
                $principal > $principalPaid ? ($prin = $prin - ($principal - $principalPaid)) : $prin;
                if($prin >= 0 && $principalPaid < $principal){
                    //if the remainder after removing principal is greater than 0
                    print_r("Cleared principal of ". number_format($principalToPay) ." for this payment id ". ($i+1) ." and update the database with principal paid of : ". number_format($principal) ."\n");
                    print_r("Balance to be moved forward is :". number_format($prin));
                    array_push($arr, $principalToPay);
                }else if($initialAmount >0 && $principalPaid < $principal){
                    ////do a partial ppayment
                    print_r("Partially clear this loan principal balance of ". number_format($principalToPay) ." for id No. ". ($i+1) ." and update principal paid to ". number_format($principal + $prin) ."\n" );
                    print_r("You have no balance left to c arry forward. "."\n");
                    //save $initialAmount + $interestPaid;
                    array_push($arr, $principal + $prin);
                }
            }else if($initialAmount > 0 && $interestPaid < $interest){
                print_r("Partially clear this loan interest balance of ". number_format($interestToPay) ." for id No. ". ($i+1) ." and update interest paid to ". number_format($initialAmount + $interestPaid) ."\n" );
                print_r("You have no balance left. "."\n");
                //save $initialAmount + $interestPaid;
                array_push($arr, $initialAmount);
            }else if($interestPaid >= $interest && $principalPaid < $principal){
                //handle only principal here
                print_r("This interest for installation id : ". number_format($i+1) . " of ". number_format($interest) ."has been cleared\n");
                print_r("The amont to be appled on pricipal is :". number_format($prin)."\n");
                ////start principal
                $principal > $principalPaid ? ($prin = $prin - ($principal - $principalPaid)) : $prin;
                if($prin >= 0 && $principalPaid < $principal){
                    //if the remainder after removing principal is greater than 0
                    print_r("Cleared principal of ". number_format($principalToPay) ." for this payment id ". ($i+1) ." and update the database with principal paid of : ". number_format($principal) ."\n");
                    print_r("Balance to be moved forward is :". number_format($prin));
                    array_push($arr, $principalToPay);
                }else if($initialAmount >0 && $principalPaid < $principal){
                    ////do a partial ppayment
                    print_r("Partially clear this loan principal balance of ". number_format($principalToPay) ." for id No. ". ($i+1) ." and update principal paid to ". number_format($initialAmount + $principalPaid) ."\n" );
                    print_r("You have no balance left to c arry forward. "."\n");
                    //save $initialAmount + $interestPaid;
                    array_push($arr, $initialAmount);
                }
            }
        }
        if($prin > 0){
            print_r("\n\nPocket change :". number_format($prin));
        }
        print_r("\n\nWe have played with an amount of ". number_format(array_sum($arr)));
    }  
    ?>
</pre>