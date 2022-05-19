<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanManagerRemarks */
/* @var $form yii\widgets\ActiveForm */
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>REF</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Interest Rate</th>
            <th>Duration</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <th><?= $investment->reference_number; ?></th>
            <th><?= $investment->investor->lastname . ' ' . $investment->investor->firstname; ?></th>
            <th><?= number_format($investment->amount_to_invest); ?></th>
            <th><?= Yii::$app->formatter->asPercent($investment->interest_rate / 100); ?></th>
             <th><?= number_format($investment->investment_duration); ?></th>
        </tr>

    </tbody>
</table>
<div class="loan-manager-remarks-form">


    <?php $form = ActiveForm::begin(); ?>



    <table class="table">
        <tr>

            <td colspan="12">
                <?= $form->field($model, 'remarks')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50, 'required' => true]) ?>
            </td>
        </tr>


        <tr>

            <td>
                <?= Html::submitButton('Approve', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
               <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'category')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'investment_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'remarks_status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>

<pre>
    
<?php= print_r($ledgerDisbursementEntries);?>
</pre>



