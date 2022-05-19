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

$this->title = $model->reference_number.' - Record payment';
$this->params['loan_id'] = $model->id;
?>
<h3><?= $this->title; ?></h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>REF</th>
            <th>Desc</th>
            <th>Due Date</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($ledgers AS $lg){ ?>
    <tr>
        <td><?= $lg->entry_reference; ?></td>
        <th><?= $lg->description; ?></th>
        <td><?= $lg->due_date; ?></td>
        <td><?= $lg->transactionAmount; ?></td>
    </tr>
    <?php } ?>
    </tbody>
    <tfoot>
    <tr class="bg-secondary text-white">
        <td colspan="3">TOTAL</td>
        <td style="background:#3243C0;font-weight:bold;"><?= Yii::$app->formatter->asCurrency($total,'UGX'); ?></td>
    </tr>
    </tfoot>
</table>
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
                                'minDate' => '0y',
                                //'maxDate' => '0',
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
                <?= $form->field($payment, 'amount_paid')->textInput(['maxlength' => true, 'value' => $total]) ?>
        </td>
    </tr>
    <tr>
        <td>
                 <?= $form->field($payment, 'payment_method')->dropdownList(
                    ArrayHelper::map($payment_methods,'id','name'),
                    ['prompt'=>'Select Method']
                ) ?> 
        </td>
        <td>
                <?= $form->field($payment, 'debit_account')->dropdownList(
                    ArrayHelper::map($pay_accounts,'gl_code','fullAccountName'),
                    ['prompt'=>'Select Dedit Account']
                ) ?> 
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
            <?= $form->field($payment, 'ledgers')->hiddenInput(['value'=>$pay_ledgers]); ?>  
            <?= $form->field($payment, 'bill_total')->hiddenInput(['value'=>$total]); ?>  
        </td>
    </tr>
    </table>
<?php ActiveForm::end(); ?>