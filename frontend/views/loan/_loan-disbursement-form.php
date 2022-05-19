<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanManagerRemarks */
/* @var $form yii\widgets\ActiveForm */
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>REF</th>
            <th>Name</th>
            <th>Amount Approved</th>
            <th>Interest Rate</th>
            <th>Loan Period</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td><?= $model->reference_number; ?></td>
            <th><?= $model->client->lastname . ' ' . $model->client->firstname; ?></th>
            <td><?= number_format($model->amount_approved); ?></td>
            <td><?= Yii::$app->formatter->asPercent($model->interest_rate / 100); ?></td>
             <td><?= number_format($model->loan_period); ?></td>
        </tr>

    </tbody>
</table>
<div class="loan-manager-remarks-form">


    <?php $form = ActiveForm::begin(); ?>



    <table class="table">
        <tr>
                   <?=
                $form->field($model, 'disbursment_date')->widget(
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

            <td colspan="12">
                        <?= $form->field($model, 'activity_remarks')
                ->textArea(['maxlength' => true, 'required' => true])
                ->label('Disbursment Remarks') ?>
            </td>
        </tr>


        <tr>

            <td>
                <?= Html::submitButton('Disburse Loan', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">
                  <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'approved_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'approved_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'client_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'loan_type')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'reference_number')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'amount_applied_for')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'interest_rate')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'interest_frequency')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'installment_frequency')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'loan_period')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>

<pre>
    
<?php= print_r($ledgerDisbursementEntries);?>
</pre>



