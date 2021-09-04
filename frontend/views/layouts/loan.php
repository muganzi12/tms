<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\client\Loan;

$loan_id = $this->params['loan_id'];

$loan = Loan::findOne($loan_id);
?>
<?php $this->beginContent('@frontend/views/layouts/main-blank.php'); ?>
<div class="mdk-header-layout__content">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page">
            <div style="padding-bottom: calc(5.125rem / 2); position: relative; margin-bottom: 1.5rem;">
                <div class="bg-dark" style="min-height: 150px;  background: linear-gradient(to right, #1C7CE0, #150051) !important;">
                    <div class="d-flex align-items-end container-fluid page__container" style="position: absolute; left: 0; right: 0; bottom: 0;">
                        <div class="avatar avatar-xl">
                            <img src="<?= $loan->client->passportPhoto; ?>" alt="avatar" class="avatar-img rounded-circle">
                        </div>
                        <div class="card-header card-header-tabs-basic nav flex" role="tablist">
                            <?= Html::a('Profile', ['loan/view', 'id' => $loan_id], ['class' => 'active']); ?>
                            <?= Html::a('Loan Guarantors', ['loan/loan-guarantors', 'id' => $loan_id], ['class' => '']); ?>
                            <?= Html::a('Loan Collateral', ['loan/loan-collateral', 'id' => $loan_id], ['class' => '']); ?>
                            <?= Html::a('Payment History', ['client/view', 'id' => $loan_id], ['class' => '']); ?>       
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid page__container">
                <div class="row">
                    <div class="col-lg-3" style="border-right:1px solid #eee;">
                        <h1 class="h4 mb-1"><?= $loan->client->firstname . ' ' . $loan->client->lastname; ?></h1>
                        <p class="text-muted"><b>File No:</b> <?= $loan->client->reference_number; ?></p>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">location_on</i>
                            <div class="flex"><?= $loan->client->address; ?></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">local_phone</i>
                            <div class="flex"><?= $loan->client->telephone; ?></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">mail_outline</i>
                            <div class="flex"><a href="mailto:<?= $loan->client->email; ?>"><?= $loan->client->email; ?></a></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">event</i>
                            <div class="flex"><?= $loan->client->age; ?> years old</div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">wc</i>
                            <div class="flex"><?= $loan->client->genderType->name; ?></div>
                        </div>

                        <ul class="list-group" style="margin-top:20px;margin-bottom:20px;">
                            <li class="list-group-item"><b>
                                    <?= Html::a('<i class="material-icons">create</i> Update loan details', ['loan/update', 'id' => $loan_id], ['class' => '']); ?>
                                </b></li>
                            <li class="list-group-item"><b>
                                    <?= Html::a('<i class="material-icons">add_circle</i> Add guarrantor', ['loan/add-loan-guarantor', 'id' => $loan_id], ['class' => '']); ?>
                                </b></li>
                            <li class="list-group-item"><b>
                                    <?= Html::a('<i class="material-icons">attach_file</i> Attach Collateral', ['loan/add-loan-collateral', 'id' => $loan_id], ['class' => '']); ?>
                                </b></li>
                            <?php if ($loan->status == 19) { ?>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">highlight_off</i> Reject Application', ['loan/reject-loan-application', 'id' => $loan_id], ['class' => '']); ?>
                                    </b></li>

                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">done</i> Approve Application', ['loan/approve-loan-application', 'id' => $loan_id], ['class' => '']); ?>
                                    </b></li>
                                        <li class="list-group-item"><b>
                                    <?= Html::a('<i class="material-icons">query_builder</i> Defer Application', ['client/view', 'id' => $loan_id], ['class' => '']); ?>
                                </b></li>
                            <?php }
                            ?>
                        
                            <?php if ($loan->status == 20) { ?>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">done_all</i> Disburse Loan', ['loan/disburse-loan', 'id' => $loan_id], ['class' => '']); ?>
                                    </b></li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <?= $content; ?>
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