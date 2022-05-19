<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Client\Investor;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

$investor_id = $this->params['investor_id'];
$investor = Investor::findOne($investor_id);
?>
<?php $this->beginContent('@frontend/views/layouts/main-blank.php'); ?>

<div class="mdk-header-layout__content">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page">
            <div style="padding-bottom: calc(5.125rem / 2); position: relative; margin-bottom: 1.5rem;">
                   <div class="bg-dark" style="min-height: 40px;  background: linear-gradient(to right, #8dbef2, #77c6ed) !important;">
                    <div class="d-flex align-items-end container-fluid page__container" style="position: absolute; left: 0; right: 0; bottom: 0;">
                        <div class="avatar avatar-xl">
                            <img src="<?= $investor->passportPhoto; ?>" alt="avatar" class="avatar-img rounded-circle">
                        </div>
                        <div class="card-header card-header-tabs-basic nav flex" role="tablist">
                            <?= Html::a('Profile', ['investor/view', 'id' => $investor_id], ['class' => '']); ?>
                            <?= Html::a('Investments', ['investor/investments', 'id' => $investor_id], ['class' => 'active']); ?>
                            <?= Html::a('Profits', ['investor/view', 'id' => $investor_id], ['class' => '']); ?>
                            <?= Html::a('Payment History', ['client/view', 'id' => $investor_id], ['class' => '']); ?>       
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
                        <h1 class="h4 mb-1"><?= $investor->firstname . ' ' . $investor->lastname; ?></h1>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">location_on</i>
                            <div class="flex"><?= $investor->physical_address; ?></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">local_phone</i>
                            <div class="flex"><?= $investor->telephone; ?></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">mail_outline</i>
                            <div class="flex"><a href="mailto:<?= $investor->email; ?>"><?= $investor->email; ?></a></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">event</i>
                            <div class="flex"><?= $investor->age; ?> years old</div>
                        </div>

                        <?php if ($investor->status == 1) { ?>
                            <?= Html::a('<i class="material-icons">add_circle_outline</i>Invest', ['investor/add-new-investment', 'id' => $investor_id], ['class' => 'btn btn-success mb-3 btn-block', 'style' => 'margin-top:15px;']); ?>
                        <?php }
                        ?>

                        <ul class="list-group" style=margin-top:20px;>
                            <li class="list-group-item"><b>
                                    <?= Html::a('<i class="material-icons">create</i> Update Profile', ['investor/update', 'id' => $investor_id], ['class' => '']); ?>
                                </b></li>
                            <li class="list-group-item"><b>
                                    <?= Html::a('<i class="material-icons">file_upload</i> Upload profile pic', ['investor/upload-photo', 'id' => $investor_id], ['class' => '']); ?>
                                </b></li>


                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!-- // END drawer-layout__content -->
        <?= $this->render('officer_leftnav'); ?>
    </div>
    <!-- // END drawer-layout -->

</div>
<!-- // END header-layout__content -->
<?php $this->endContent(); ?>