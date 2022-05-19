<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\client\LoanAmortization;
use nullref\datatable\DataTable;
use yii\helpers\Url;
use common\models\client\Loan;
use common\models\loan\Ledger;

$this->title = $model->client->firstname . ' ' . $model->client->lastname;
$this->params['loan_id'] = $model->id;
$this->params['hide_page_title'] = true;
\yii\web\YiiAsset::register($this);
$balance = Loan::getTotalPrincipal($model->id);
$princ = Loan::getPrincipalPaid($model->id);
$interest = Loan::getTotalInterest($model->id);
$interestpaid = Loan::getTotalInterestPaid($model->id);
$totalrate = Loan::getTotalRate($model->id);
$loggedIn = Yii::$app->user;
?>
<style>
    .profile-section{}
    .profile-section h5{
        border-bottom: 3px solid #3C8BE5;
        color:#135095;
        font-weight: bold !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<section class="sheet padding-10mm" style="padding:0 7px 0 7px;">
    <div class="profile-section" style="margin-top:0px;">
        <h5>Client Details</h5>
        <?= $this->render('details/client-details', ['model' => $model]); ?>
    </div>
    <div class="profile-section" style="margin-top:0px;">
        <h5>Loan Application Details</h5>
        <?= $this->render('details/loan-details', ['model' => $model]); ?>
    </div>
<?php if ($model->status !== 41) { ?>
    <div class="profile-section" style="margin-top:0px;">
        <h5>Guarantors Details</h5>
        <?= $this->render('details/loan-guarantors', ['model' => $model]); ?>
    </div>
    <div class="profile-section" style="margin-top:0px;">
        <h5>Collateral Details</h5>
        <?= $this->render('details/loan-collateral', ['model' => $model]); ?>
    </div>
    <div class="profile-section" style="margin-top:0px;">
        <h5>Loan Officer's Remarks </h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->loanOfficerRemarks AS $lg) { ?>
                    <tr>
                        <td><?= $lg->remarks; ?></td>

                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>

    <div class="profile-section" style="margin-top:0px;">
        <h5>Credit Manager's Remarks </h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->creditManagerRemarks AS $lg) { ?>
                    <tr>
                        <td><?= $lg->remarks; ?></td>

                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
        <div class="profile-section" style="margin-top:0px;">
    <h5>Personal Loan Requirements</h5>
    <h5>1. Borrower</h5>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="info">
                <th>S/N</th>
                <th>Requirement</th>
                <th>Rate</th>

            </tr>
        </thead>

        <tbody>
            <?php
            $i = 1;
            foreach ($model->borrowerRequirement AS $ge) {
                ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $ge->requirement->name ?></td>
                    <td><?= $ge->rate; ?></td>



                </tr>
            <?php } ?>
        </tbody>


    </table>

    <h5>2. Guarantor</h5>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="info">
                <th>S/N</th>
                <th>Requirement</th>
                <th>Rate</th>

            </tr>
        </thead>

        <tbody>
            <?php
            $i = 1;
            foreach ($model->gurantorRequirement AS $ge) {
                ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $ge->requirement->name ?></td>
                    <td><?= $ge->rate; ?></td>

                </tr>
            <?php } ?>
        </tbody>


    </table>
</div>
<?php }
?>
</section>
<?php if ($model->status == 41) { ?>
    <p>
        <?= Html::button('Download', ['class' => 'pull-right btn btn-secondary', 'onclick' => 'approvePayment()']) ?>
    </p>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Due Date</th>
                <th>Total Amount</th>
                <th>Principal Due</th>
                <th>Principal Paid</th>
                <th>Interest Due</th>
                <th>Interest Paid</th>
                <th>Total Balance</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model->loanScheduleEntries AS $lg) { ?>
                <tr>
                    <td><?= '<b><a href="' . Url::to(['loan/view-payments', 'id' => $lg->id]) . '">' . $lg->due_date . "</a></b>"; ?></td>
                    <td><?= number_format($lg->principal_amount + $lg->interest_amount); ?></td>
                    <td><?= number_format($lg->principal_amount); ?></td>
                    <td><?= number_format($lg->principal_paid); ?></td>
                    <td><?= number_format($lg->interest_amount); ?></td>
                    <td><?= number_format($lg->interest_paid); ?></td>
                    <td><?= number_format(($lg->principal_amount - $lg->principal_paid) + ($lg->interest_amount - $lg->interest_paid)); ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="bg-secondary text-white">
                <th>TOTAL</td>
                <td>= <?= number_format($balance['principal_due'] + $interest['interest_due']); ?></td>
                <td>= <?= number_format($balance['principal_due']); ?></td>
                <td>= <?= number_format($princ['principal_paid']); ?></td>
                <td>= <?= number_format($interest['interest_due']); ?></td>
                <td>= <?= number_format($interestpaid['interest_paid']); ?></td>
                <td>= <?= number_format(($balance['principal_due'] - $princ['principal_paid']) + ($interest['interest_due'] - $interestpaid['interest_paid'])); ?></td>

            </tr>
        </tfoot>
    </table>

<?php }
?>
<br>
<h3> PENALTIES UNDER THIS LOAN</h3>
<p>
    <?= Html::button('Make Payment', ['class' => 'pull-right btn btn-primary','onclick'=>'makePayment()']) ?>
</p>

    <?php
    echo DataTable::widget([
        'data' => $model->penaltiesEntries,
        'tableOptions' => ['class' => 'table table-striped', 'style' => 'width: 100%'],
        'id' => 'payment_history',
        'columns' => [
            ['attribute' => 'checkboxField', 'title' => ''],
            ['attribute' => 'entry_reference', 'title' => 'REF'],
            ['attribute' => 'description', 'title' => 'Description'],
            ['attribute' => 'due_date', 'title' => 'Due Date',],
            ['attribute' => 'transactionDate', 'title' => 'Recorded At',],
            ['attribute' => 'transactionAmount', 'title' => 'Amount'],
              ['attribute' => 'statusButton', 'title' => 'Status'],
        ],
    ]);
    ?>

<script>
    function getSelectedRows() {
        return $('input:checked').map(function () {
            return this.value;
        }).get();
    }

    //Selected Records
    function getSelectedRecords(_keys) {
        let selected_values = [];
        for (i = 0; i < _keys.length; i++) {
            var _value = $('#row' + _keys[i]).val();
            selected_values.push(_value);
        }
        return selected_values;
    }

    /**
     * Make payment
     */
    function makePayment() {
        var keys = getSelectedRows();
        if (keys.length > 0) {
            var id = getSelectedRecords(keys);
        }
        ;
        //Remove null values
        var filteredKeys = id.filter(function (el) {
            return el != null;
        });
             return  location.href="<?= Url::to(['loan/make-penalty-payment','id'=>$model->id]); ?>&ledger="+filteredKeys;
    }


</script>

<pre>
    <?php
    foreach ($ledger_entries as $key) {
        # code...
        $dueDate = $key["next_date"];
        if (!empty($dueDate)) {
            # code...
            $today = time();
            $dueDateTime = strtotime($dueDate);
            $nextDate = strtotime($dueDate . "+1 Week");
            $payMentid = $key["id"];
            if ($today > $dueDateTime) {
                ///insert into DB & upDate
                $fine = 20000;
                $status = 25;
                $debit=41223;
                $finePayLoad = array([
                        "description" => $key["description"] . " fine",
                        "entry_reference" => $key["entry_reference"],
                        "amount" => $fine,
                        "debit_account" => $debit,
                        "credit_account" => $key["credit_account"],
                        "entry_type" => $key["entry_type"],
                        "entry_reference_id" => $key["entry_reference_id"],
                        "created_at" => time(),
                        "created_by" => $key["created_by"],
                        "member_account" => $key["member_account"],
                        "entry_period" => $key["entry_period"],
                        "ledger_status" => $status,
                ]);
                $updatePayLoad = array('next_date' => date("Y-m-d", $nextDate));
                Yii::$app->db->createCommand()->insert('ledger', $finePayLoad[0])->execute();
                Yii::$app->db->createCommand('UPDATE ledger SET next_date = "' . date("Y-m-d", $nextDate) . '"  WHERE id =' . $payMentid)->execute();
            }
        }
    }
    ?>




</pre>

<pre>
    
    <?php
    $count = count($model->loanLedgerEntries);
    if ($count <= 0) {
        foreach ($model->loanScheduleEntries as $key) {
            $refNumber = \common\models\loan\LoanPaymentSchedule::setNextReferenceNumber();
            $ref_num = 1;
            $finePayLoad = array([
                    "description" => 'Principal',
                    "entry_reference" => $refNumber + $ref_num,
                    "amount" => $key["principal_amount"],
                    "debit_account" => 11110,
                    "credit_account" => 11300,
                    "entry_type" => 'LOAN',
                    "entry_reference_id" => $model->id,
                    "schedule_id" => $key["id"],
                    "created_at" => time(),
                    "created_by" => Yii::$app->member->id,
                    "member_account" => $model->client->account_number,
                    "entry_period" => date('Y'),
                    "due_date" => $key["due_date"],
                    "next_date" => date("Y-m-d", strtotime($key["due_date"] . "+1 Day")),
                    "ledger_status" => Ledger::STATUS_NOTPAID,
            ]);

            $interest = array([
                    "description" => 'Interest',
                    "entry_reference" => $refNumber + $ref_num,
                    "amount" => $key["interest_amount"],
                    "debit_account" => 12210,
                    "credit_account" => 41110,
                    "entry_type" => 'LOAN',
                    "entry_reference_id" => $model->id,
                    "schedule_id" => $key["id"],
                    "created_at" => time(),
                    "entry_period" => date('Y'),
                    "due_date" => $key["due_date"],
                    "next_date" => date("Y-m-d", strtotime($key["due_date"] . "+1 Day")),
                    "created_by" => Yii::$app->member->id,
                    "member_account" => $model->client->account_number,
                    "ledger_status" => Ledger::STATUS_NOTPAID,
            ]);
            $ref_num += 1;
            Yii::$app->db->createCommand()->insert('ledger', $finePayLoad[0])->execute();
            Yii::$app->db->createCommand()->insert('ledger', $interest[0])->execute();
        }
    }
    ?>
</pre>

