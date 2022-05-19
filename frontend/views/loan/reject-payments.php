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

$this->title = $loan->entry_reference.' - Reject payments';
$this->params['ledger_id'] = $loan->id;
?>

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
    <tr>
        <td><?= $loan->entry_reference; ?></td>
        <th><?= $loan->description; ?></th>
        <td><?= $loan->due_date; ?></td>
        <td><?= $loan->amount; ?></td>
    </tr>
    </tbody>
    <tfoot>
    <tr class="bg-secondary text-white">
        <td colspan="3">TOTAL</td>
        <td style="background:#3243C0;font-weight:bold;"><?= Yii::$app->formatter->asCurrency($loan->amount,'UGX'); ?></td>
    </tr>
    </tfoot>
</table>
<?php $form = ActiveForm::begin(); ?>
    <table class="table">

    <tr>
        <td colspan="3">
                <?= $form->field($payment, 'remarks')->textArea(['rows'=>2]) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= Html::submitButton('Approve Payment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:30px;']) ?>
        </td>
          <td colspan="2">
              
              
                <?= $form->field($payment, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($payment, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($payment, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($payment, 'updated_by')->hiddenInput()->label(false) ?>
                <?= $form->field($payment, 'category')->hiddenInput()->label(false) ?>
                <?= $form->field($payment, 'loan_id')->hiddenInput()->label(false) ?>
                <?= $form->field($payment, 'client_id')->hiddenInput()->label(false) ?>
                <?= $form->field($payment, 'remarks_status')->hiddenInput()->label(false) ?>
                <?= $form->field($payment, 'id')->hiddenInput()->label(false) ?>
        </td>
    </tr>
    </table>
<?php ActiveForm::end(); ?>