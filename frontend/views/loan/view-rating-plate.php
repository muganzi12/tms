<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\client\LoanAmortization;
use nullref\datatable\DataTable;
use yii\helpers\Url;
use common\models\client\Loan;
use yii\bootstrap\Modal;
$this->title = $model->reference_number;
$this->params['loan_id'] = $model->id;
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
<section class="sheet padding-10mm" style="padding:0 7px 0 7px;">
    <div class="profile-section" style="margin-top:0px;">
        <h5>Application Details</h5>
<?= $this->render('details/loan-details', ['model' => $model]); ?>
    </div>


</section>
    <?php if ($model->status == 41) { ?>
    <p>
    <?= Html::button('Download', ['class' => 'pull-right btn btn-secondary', 'onclick' => 'approvePayment()']) ?>
    </p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Due Date</th>
                <th>Principal Due</th>
                <th>Principal Paid</th>
                <th>Interest Due</th>
                <th>Interest Paid</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($model->loanScheduleEntries AS $lg) { ?>
                <tr>
                    <td><?= '<b><a href="' . Url::to(['loan/view-payments', 'id' => $lg->id]) . '">' . $lg->due_date . "</a></b>"; ?></td>
                    <td><?= number_format($lg->principal_amount); ?></td>
                    <td><?= number_format($lg->principal_paid); ?></td>
                    <td><?= number_format($lg->interest_amount); ?></td>
                    <td><?= number_format($lg->interest_paid); ?></td>
                </tr>
    <?php } ?>
        </tbody>
        <tfoot>
            <tr class="bg-secondary text-white">
                <td>TOTAL</td>
                <td>= <?= number_format($balance['principal_due']); ?></td>
                <td>= <?= number_format($princ['principal_paid']); ?></td>
                <td>= <?= number_format($interest['interest_due']); ?></td>
                <td>= <?= number_format($interestpaid['interest_paid']); ?></td>

            </tr>
        </tfoot>
    </table>

<?php }
?>
    
    <h5>Rated Items</h5>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="info">
            <th>S/N</th>
            <th>Item</th>
            <th>Rate</th>
            <th>Mark</th>
             <th>Reason</th>
            <th>Option</th>

        </tr>
    </thead>
  
        <tbody>
            <?php
              $i=1;
            foreach ($model->loanRatedItems AS $ge) {
                ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $ge->item->name ?></td>
                    <td><?= @$ge->guadge->name; ?></td>
                    <td><?= $ge->mark; ?></td>
                       <td><?= $ge->reason; ?></td>

                        <?php if ($loggedIn->can('Approving Authority')) { ?>
                            <td>
                                <?= '<b class="btn btn-success"><a href="' . Url::to(['loan/rate-client', 'id' => $ge->id, 'ln' => $ge->loan->id]) . '">' . '<span style="color:#fff;font-size:85%;">Score ' . "</a></b>"; ?>
                           
                            </td>
                        <?php } ?>
               
                </tr>
            <?php } ?>
        </tbody>
                <tfoot>
            <tr class="bg-secondary text-white">
                <td>TOTAL</td>
                <td></td>
                 <td></td>
                <td>= <?= number_format($totalrate['total_rate']); ?></td>    
                <td></td>   
                <td></td>

            </tr>
             <tr class="bg-contrast text-black">
                <td>Out of five</td>
                <td></td>
                 <td></td>
                <td>= <?= $totalrate['total_rate']/5; ?></td>    
                <td></td>   
                <td></td>

            </tr>
             <tr class="bg-secondary text-white">
                <td>Out of ten</td>
                <td></td>
                 <td></td>
                <td>= <?= $totalrate['total_rate']/10; ?></td>    
                <td></td>   
                <td></td>

            </tr>
        </tfoot>
      
</table>
    
    <div class="row">
    <div class="col-lg-9">
        <h2>Assessment Team Members</h2>
    </div>

</div>

<table class="table table-bordered">
   <thead>
        <tr class="info">
            <th>S/N</th>
            <th>Item</th>
            <th>Rate</th>
            <th>Mark</th>
             <th>Reason</th>
            <th>Option</th>

        </tr>
    </thead>
    <tbody>
        <?php 
        $i=1;
          foreach ($model->loanRatedItems AS $ge) { ?>
            <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $ge->item->name ?></td>
                    <td><?= @$ge->guadge->name; ?></td>
                    <td><?= $ge->mark; ?></td>
                       <td><?= $ge->reason; ?></td>
               
                <td>
                    <div class="btn-group mr-2" role="group" aria-label="Options">
                        <?php
                            Modal::begin([
                                'id' => 'edit_intervention_'.$ge->id,
                                'options' => ['style' => 'background-color:rgba(0, 0, 0, 0.75);padding-top:20px;'],
                                'headerOptions' => ['style' => 'border-bottom:1px solid #ccc;background:#8A2BE2;text-align:left;'],
                                'bodyOptions' => ['style' => 'text-align:left;'],
                                'size' => Modal::SIZE_LARGE,
                                'closeButton' => false,
                                'header' => '<h4 style="text-align:left;line-height:0.75;color:white;">Remove '.$ge->id.'</h4>',
                                'toggleButton' => ['label' => '<span class="oi oi-pencil mr-1" style="color:#fff;font-size:85%;"></span>', 'class' => 'btn btn-success'],
                            ]);
                            echo $this->render('_score-form', ['model' => $ge,'activity'=>'update_record']);
                            Modal::end();
                            ?>
                        
                    </div>
                    <a type="button" class="btn bg-youtube" href="<?= Url::to(['assessment-team/delete-member', 'id' => $ge->id]); ?>"><span class="oi oi-trash mr-1"></span></a> 
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


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
        return  location.href = "<?= Url::to(['loan/download-payment-history', 'id' => $model->id]); ?>";
    }


    /**
     * Make payment
     */
    function approvePayment() {
        var keys = getSelectedRows();
        if (keys.length > 0) {
            var id = getSelectedRecords(keys);
        }
        ;
        //Remove null values
        var filteredKeys = id.filter(function (el) {
            return el != null;
        });
        return  location.href = "<?= Url::to(['loan/download-payment-history', 'id' => $model->id]); ?>";
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
                $status = 79;
                $finePayLoad = array([
                        "description" => $key["description"] . " fine",
                        "entry_reference" => $key["entry_reference"],
                        "amount" => $fine,
                        "debit_account" => $key["debit_account"],
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
    print_r($model->loanRatedItems);
    ?>




</pre>