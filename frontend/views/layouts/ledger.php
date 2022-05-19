<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\client\Loan;
use yii\helpers\ArrayHelper;
use common\models\ReferenceHelper;

$ledger_id = $this->params['ledger_id'];

$loan = common\models\loan\Ledger::findOne($ledger_id);
$balance = Loan::getTotalPrincipal($loan->loanLedger->id);
$princ = Loan::getPrincipalPaid($loan->loanLedger->id);
$interest = Loan::getTotalInterest($loan->loanLedger->id);
$interestpaid = Loan::getTotalInterestPaid($loan->loanLedger->id);
?>
<?php $this->beginContent('@frontend/views/layouts/main-blank.php'); ?>
<div class="mdk-header-layout__content">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page">
            <div style="padding-bottom: calc(5.125rem / 2); position: relative; margin-bottom: 1.5rem;">
                 <div class="bg-dark" style="min-height: 40px;  background: linear-gradient(to right, #8dbef2, #77c6ed) !important;">
                    <div class="d-flex align-items-end container-fluid page__container" style="position: absolute; left: 0; right: 0; bottom: 0;">
                        <div class="avatar avatar-xl">
                            <img src="<?= $loan->loanLedger->client->passportPhoto; ?>" alt="avatar" class="avatar-img rounded-circle">
                        </div>
                        <div class="card-header card-header-tabs-basic nav flex" role="tablist">
                            <?= Html::a('<i class="material-icons mr-1">description</i> Loan Application', ['loan/view', 'id' => $loan->loanLedger->id], ['class' => 'active']); ?>
                            <?= Html::a('<i class="material-icons mr-1">supervisor_account</i> Guarantors', ['loan/loan-guarantors', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                            <?= Html::a('<i class="material-icons mr-1">perm_media</i> Collateral', ['loan/loan-collateral', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                            <?= Html::a('<i class="material-icons mr-1">payment</i> Payment History', ['loan/payment-history', 'id' => $loan->loanLedger->id], ['class' => '']); ?> 

                            <?= Html::a('<i class="material-icons mr-1">payment</i> Proof of Payment', ['loan/proof-of-payments', 'id' => $loan->loanLedger->id], ['class' => '']); ?> 
                            <?= Html::a('<i class="material-icons mr-1">fingerprint</i>Profile', ['client/view', 'id' => $loan->loanLedger->client->id], ['class' => 'pull-right']); ?>
                            <?= Html::a('<i class="material-icons mr-1">list</i>Activity Logs', ['client/activity-logs', 'id' => $loan->loanLedger->client->id], ['class' => 'pull-right']); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid page__container">
                <div class="row">


                    <div class="col-lg-9">
                        <div class="container-fluid page__heading-container">
                            <div class=" d-flex">
                                <div class="flex">
                                    <h3><?= $this->title; ?></h3>
                                </div>
                                <?= ArrayHelper::keyExists('topright_button', $this->params) ? Html::a($this->params['topright_button_label'], $this->params['topright_button_link'], ['class' => 'btn ' . $this->params['topright_button_class']]) : ('') ?> 
                            </div>
                        </div>
                        <?= $content; ?>
                    </div>
                    <div class="col-lg-3" style="border-left:0px solid #eee;">
                        <h1 class="h4 mb-1">
                            <a href="<?= Url::to(['client/view', 'id' => $loan->loanLedger->client->id]); ?>"><?= $loan->loanLedger->client->firstname . ' ' . $loan->loanLedger->client->lastname; ?></a></h1>
                        <p class="text-muted"><b>External ID:</b> <?= $loan->loanLedger->client->external_id; ?></p>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">location_on</i>
                            <div class="flex"><?= $loan->loanLedger->client->address; ?></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">local_phone</i>
                            <div class="flex"><?= $loan->loanLedger->client->telephone; ?></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">mail_outline</i>
                            <div class="flex"><a href="mailto:<?= $loan->loanLedger->client->email; ?>"><?= $loan->loanLedger->client->email; ?></a></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">event</i>
                            <div class="flex"><?= $loan->loanLedger->client->age; ?> years old</div>
                        </div>
                        
                         <h1 class="h4 mb-1" style="color:red;">
                            <div class="flex">Balance:<?= number_format(($balance['principal_due']-$princ['principal_paid'])+($interest['interest_due']-$interestpaid['interest_paid'])); ?></div>
                        </h1>


                        <ul class="list-group" style="margin-top:20px;margin-bottom:20px;">
                            <?php if ($loan->loanLedger->status == 19) { ?>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">create</i> Update loan details', ['loan/update', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                                    </b></li>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">add_circle</i> Add guarrantor', ['loan/add-loan-guarantor', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                                    </b></li>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">attach_file</i> Attach Collateral', ['loan/add-loan-collateral', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                                    </b></li>


                            <?php }
                            ?>
                            <?php if ($loan->loanLedger->application_payment_status == "") { ?>

                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">add_circle</i> Record Application Fees', ['loan/add-application-fees', 'id' =>$loan->loanLedger->id], ['class' => '']); ?>
                                    </b></li>
                            <?php }
                            ?>
                            <?php if ($loan->loanLedger->status == 41) { ?>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">date_range</i> Generate Payment Schedule', ['loan/generate-schedule', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                                    </b></li>
                            <?php }
                            ?>
                            <?php if ($loan->loanLedger->status == 19 && $loan->loanLedger->application_payment_status == 42) { ?>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">highlight_off</i> Reject Application', ['loan/reject-loan-application', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                                    </b></li>

                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">done</i> Approve Application', ['loan/approve-loan-application', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                                    </b></li>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">query_builder</i> Defer Application', ['client/view', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                                    </b></li>
                            <?php }
                            ?>


                            <?php if ($loan->loanLedger->status == 36) { ?>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">redo</i> Reverse Application', ['loan/reverse-loan-application', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                                    </b></li>
                            <?php }
                            ?>

                            <?php if ($loan->loanLedger->status == 20) { ?>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">done_all</i> Disburse Loan', ['loan/disburse-loan', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                                    </b></li>
                            <?php }
                            ?>


                            <?php if ($loan->loanLedger->status == 41) { ?>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">done_all</i> Merge Loan', ['loan/merge-loan', 'id' => $loan->loanLedger->id], ['class' => '']); ?>
                                    </b></li>
                            <?php }
                            ?>

                            <li class="list-group-item"><b>
                                    <?= Html::button('Record Payment', ['class' => 'pull-right btn btn-primary','onclick'=>'makePayment()']) ?>
                                </b></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <!-- // END drawer-layout__content -->
        <?= $this->render('new_leftnav'); ?>
    </div>
    <!-- // END drawer-layout -->

</div>
<!-- // END header-layout__content -->
<?php $this->endContent(); ?>