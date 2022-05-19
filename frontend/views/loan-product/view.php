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
            <td>
            <b>Name</b><br/>
            <?= $model->name; ?>
            </th>
              <td>
                <b>Product Code</b><br/>
                <?= $model->product_code; ?>
            </th>
            <td>
                <b>Description</b><br/>
                <?= $model->description; ?>
            </th>
               <td>
                <b>Interest Rate</b><br/>
                <?= Yii::$app->formatter->asPercent($model->interest_rate/100); ?>
            </td>
        </tr>
        <tr>
         
            <td>
                <b>Minimum Amount</b><br/>
                <?= Yii::$app->formatter->asCurrency($model->minimum_amount,'UGX'); ?>
            </td>
               <td>
                <b>Maximum Amount</b><br/>
                <?= Yii::$app->formatter->asCurrency($model->maximum_amount,'UGX'); ?>
            </td>
            <td>
                <b>Maximum Repayment Period</b><br/>
                <?= $model->maximum_repayment_period; ?> Months
            </td>
                <td>
                <b>Late Payment Penalty</b><br/>
                <?= Yii::$app->formatter->asCurrency($model->penalty,'UGX'); ?>
            </td>
        </tr>
        

      
        <tr>
            <td>
                <b>Principal Installment Frequency</b><br/>
                <?= $model->principal_installment_frequency; ?>
            </th>
               <td>
                <b>Interest Frequency</b><br/>
                <?= $model->interest_frequency; ?>
            </th>
        
                 <td>
                <b>Date Registered</b><br/>
                <?= Yii::$app->formatter->asDate($model->created_at); ?>
            </td>
            <td>
                <b>Recorded by</b><br/>
                <?= $model->createdBy->fullnames; ?>
            </td>
        </tr>
    
    </table>


<h2>Required Documents
        <a href="<?= Url::to(['loan-product/specify-document-required','id'=>$model->id]); ?>" class="btn btn-info" style="float:right;"> <i class="material-icons">add</i> New Document</a>
</h2>
<?= Html::ul(ArrayHelper::map($model->requiredDocuments,'id','name'), ['class' => 'list-group', 'itemOptions' => ['class' => 'list-group-item']]) ?>
<h2 style="margin-top:20px;">Ledger Transactions
    <a href="<?= Url::to(['ledger-config/add-new-transaction','id'=>$model->id]); ?>" class="btn btn-info"  style="float:right;"> <i class="material-icons">add</i> New Transaction</a>
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