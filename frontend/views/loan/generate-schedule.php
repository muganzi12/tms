<?php
use yii\helpers\Html;
use common\models\client\LoanAmortization;
use common\models\loan\LedgerTransactionConfig;
use common\models\loan\LedgerHelper;

$this->title = $model->reference_number.' payment schedule';
$this->params['loan_id'] = $model->id;
?>
<h3><?= $this->title; ?></h3>
<table class="table">
    <thead>
    <tr>
        <th>Due Date</th>
        <th>Principal</th>
        <th>Interest</th>
        <th>Total Payments</th>
        <th>Closing Balance</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach($model->paymentSchedule AS $paySchedule){
            $schedule = $paySchedule->jsonSerialize();
            ?>
        <tr>
             <td>
                <?= Yii::$app->formatter->asDate($schedule['date']); ?>
            </td>
            <td>
                <?= Yii::$app->formatter->asCurrency($schedule['principalRounded'],'UGX'); ?>
            </td>
            <td>
                <?= Yii::$app->formatter->asCurrency($schedule['interestRounded'],'UGX'); ?>
            </td>
            <td>
                <?= Yii::$app->formatter->asCurrency($schedule['totalPaymentRounded'],'UGX'); ?>
            </td>
            <td>
                <?= Yii::$app->formatter->asCurrency($schedule['closingBalance'],'UGX'); ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<h2>Ledger Entries</h2>
<?php
$shortterm = LedgerTransactionConfig::transactionByTag(1,'application');
$ledgerHelper = new LedgerHelper(['tag'=>'approved','loan_id'=>1]);
$ledger = $ledgerHelper->prepareLoanScheduleEntries();
?>
<table class="table">
    <thead>
        <tr>
            <th>Due Date</th>
            <th>Description</th>
            <th>REF</th>
            <th>Debit Account</th>
            <th>Credit Account</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($model->ledgerEntries AS $lg){ ?>
        <tr>
            <th><?= $lg->due_date; ?></th>
            <td><?= $lg->description; ?></td>
            <td><?= $lg->entry_reference; ?></td>
            <td><?= $lg->debit_account; ?></td>
            <td><?= $lg->credit_account; ?></td>
            <td><?= $lg->amount; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>