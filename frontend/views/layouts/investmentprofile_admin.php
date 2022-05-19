<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Client\Investor;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use common\models\client\Investment;

$investment_id = $this->params['investment_id'];

$investment = Investment::findOne($investment_id);
?>
<?php $this->beginContent('@frontend/views/layouts/main-blank.php'); ?>
<div class="mdk-header-layout__content">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page">
            <div style="padding-bottom: calc(5.125rem / 2); position: relative; margin-bottom: 1.5rem;">
                <div class="bg-dark" style="min-height: 40px;  background: linear-gradient(to right, #1C7CE0, #150051) !important;">
                    <div class="d-flex align-items-end container-fluid page__container" style="position: absolute; left: 0; right: 0; bottom: 0;">
                        <div class="avatar avatar-xl">
                            <img src="<?= $investment->investor->passportPhoto; ?>" alt="avatar" class="avatar-img rounded-circle">
                        </div>
                        <div class="card-header card-header-tabs-basic nav flex" role="tablist">
                            <?= Html::a('Profile', ['investor/view', 'id' => $investment->investor->id], ['class' => 'active']); ?>
                            <?= Html::a('Investments', ['investor/investments', 'id' => $investment->investor->id], ['class' => '']); ?>
                            <?= Html::a('Profits', ['investor/view', 'id' => $investment_id], ['class' => '']); ?>
                            <?= Html::a('Payment History', ['loan/investment-payment-history', 'id' => $investment_id], ['class' => '']); ?>       
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid page__container">
                <div class="row">

                    <div class="col-lg-9">
                        <?= $content; ?>
                    </div>
                    <div class="col-lg-3" style="border-right:1px solid #eee;">
                        <h1 class="h4 mb-1"><?= $investment->investor->firstname . ' ' . $investment->investor->lastname; ?></h1>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">location_on</i>
                            <div class="flex"><?= $investment->investor->physical_address; ?></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">local_phone</i>
                            <div class="flex"><?= $investment->investor->telephone; ?></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">mail_outline</i>
                            <div class="flex"><a href="mailto:<?= $investment->investor->email; ?>"><?= $investment->investor->email; ?></a></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">event</i>
                            <div class="flex"><?= $investment->investor->age; ?> years old</div>
                        </div>

                        <?php if ($investment->status == 19) { ?>
                            <?= Html::a('<i class="material-icons">add_circle_outline</i>Invest', ['investor/add-new-investment', 'id' => $investment_id], ['class' => 'btn btn-success mb-3 btn-block', 'style' => 'margin-top:15px;']); ?>
                        <?php }
                        ?>

                        <ul class="list-group" style=margin-top:20px;>
                            <li class="list-group-item"><b>
                                    <?= Html::a('<i class="material-icons">create</i> Update Profile', ['investor/update', 'id' => $investment_id], ['class' => '']); ?>
                                </b></li>
                            <li class="list-group-item"><b>
                                    <?= Html::a('<i class="material-icons">file_upload</i> Upload profile pic', ['investor/upload-photo', 'id' => $investment_id], ['class' => '']); ?>
                                </b></li>
                            <?php if ($investment->status == 19) { ?>
                                <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">done</i> Approve Investment', ['investor/approve-investment', 'id' => $investment_id], ['class' => '']); ?>
                                    </b></li>
                            <?php }
                            ?>


                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!-- // END drawer-layout__content -->
        <?= $this->render('admin_leftnav'); ?>
    </div>
    <!-- // END drawer-layout -->

</div>
<!-- // END header-layout__content -->
<?php $this->endContent(); ?>