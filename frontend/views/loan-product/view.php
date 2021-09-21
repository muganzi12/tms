<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = $model->name;

?>
<div class="row">
    <div class="col-lg-12" style="padding:0px;">
    <table class="table">
        <tr>
            <td style='width:50%;'>
            <b>Name</b><br/>
            <?= $model->name; ?>
            </th>
            <td>
                <b>Description</b><br/>
                <?= $model->description; ?>
            </th>
        </tr>
        <tr>
            <td>
                <b>Interest Rate</b><br/>
                <?= Yii::$app->formatter->asPercent($model->interest_rate/100); ?>
            </td>
            <td>
                <b>Minimum Amount</b><br/>
                <?= Yii::$app->formatter->asCurrency($model->minimum_amount,'UGX'); ?>
            </td>
        </tr>
         <tr>
            <td>
                <b>Maximum Amount</b><br/>
                <?= Yii::$app->formatter->asCurrency($model->maximum_amount,'UGX'); ?>
            </td>
            <td>
                <b>Maximum Repayment Period</b><br/>
                <?= $model->maximum_repayment_period; ?> Months
            </td>
        </tr>
        <tr>
            <td>
                <b>Status</b><br/>
                <?= $model->status; ?>
            </td>
            <td>
                <b>Late Payment Fees</b><br/>
                <?= Yii::$app->formatter->asCurrency($model->penalty,'UGX'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Date Registered</b><br/>
                <?= Yii::$app->formatter->asDate($model->created_at); ?>
            </td>
            <td>
                <b>Recorded by</b><br/>
                <?= $model->created_by; ?>
            </td>
        </tr>
    </table>

<h2>Required Documents
        <a href="#" class="btn btn-info" style="float:right;"> <i class="material-icons">add</i> New Document</a>
</h2>
<?= Html::ul(ArrayHelper::map($model->requiredDocuments,'id','name'), ['class' => 'list-group', 'itemOptions' => ['class' => 'list-group-item']]) ?>
<h2 style="margin-top:20px;">Ledger Transactions
    <a href="<?= Url::to(['ledger-config/create']); ?>" class="btn btn-info"  style="float:right;"> <i class="material-icons">add</i> New Transaction</a>
</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Transaction Name</th>
                    <th>Credit Account</th>
                    <th>Debit Account</th>
                    <th>Amount</th>
                </tr>
        </thead>
        <tbody>
        <?php foreach($model->ledgerTransactions AS $ledger){ ?>
        <tr>
            <td>
                <?= $ledger->transaction_name; ?>
                <br/><badge class="badge badge-dark"><?= $ledger->tags;?></badge>
            </td>
            <td>
                <?= $ledger->creditAccount->fullAccountName?>
            </td>
            <td>
                <?= $ledger->debitAccount->fullAccountName; ?>
            </td>
            <td>
                <?= $ledger->amount; ?>
            </td>
        </tr>
            <?php } ?>
        </tbody>
        </table>
    </div>
</div>