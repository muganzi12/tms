<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\client\Client;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

$client_id = $this->params['client_id'];

$client = Client::findOne($client_id);
?>
<?php $this->beginContent('@frontend/views/layouts/main-blank.php'); ?>
    <div class="mdk-header-layout__content">
                <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                    <div class="mdk-drawer-layout__content page">
                        <div style="padding-bottom: calc(5.125rem / 2); position: relative; margin-bottom: 1.5rem;">
                            <div class="bg-dark" style="min-height: 150px;  background: linear-gradient(to right, #1C7CE0, #150051) !important;">
                                <div class="d-flex align-items-end container-fluid page__container" style="position: absolute; left: 0; right: 0; bottom: 0;">
                                    <div class="avatar avatar-xl">
                                        <img src="<?= Url::base(true) ?>/flowdash/assets/images/avatar/demi.png" alt="avatar" class="avatar-img rounded" style="border: 2px solid white;">
                                    </div>
                                    <div class="card-header card-header-tabs-basic nav flex" role="tablist">
                                    <?= Html::a('Profile',['client/view','id'=>$client_id], ['class' => 'active']); ?>
                                    <?= Html::a('Supporting Documents',['client/view','id'=>$client_id], ['class' => '']); ?>
                                    <?= Html::a('Loan Applications',['client/view','id'=>$client_id], ['class' => '']); ?>
                                    <?= Html::a('Payment History',['client/view','id'=>$client_id], ['class' => '']); ?>       
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid page__container">
                            <div class="row">
                                <div class="col-lg-3" style="border-right:1px solid #eee;">
                                    <h1 class="h4 mb-1"><?= $client->firstname.' '.$client->lastname;?></h1>
                                    <p class="text-muted"><b>File No:</b> <?= $client->reference_number; ?></p>
                                    <div class="text-muted d-flex align-items-center">
                                        <i class="material-icons mr-1">location_on</i>
                                        <div class="flex"><?= $client->address; ?></div>
                                    </div>
                                    <div class="text-muted d-flex align-items-center">
                                        <i class="material-icons mr-1">local_phone</i>
                                        <div class="flex"><?= $client->telephone; ?></div>
                                    </div>
                                    <div class="text-muted d-flex align-items-center">
                                        <i class="material-icons mr-1">mail_outline</i>
                                        <div class="flex"><a href="mailto:<?= $client->email; ?>"><?= $client->email; ?></a></div>
                                    </div>
                                    <div class="text-muted d-flex align-items-center">
                                        <i class="material-icons mr-1">event</i>
                                        <div class="flex"><?= $client->age; ?> years old</div>
                                    </div>
                                    <div class="text-muted d-flex align-items-center">
                                        <i class="material-icons mr-1">wc</i>
                                        <div class="flex"><?= $client->genderType->name; ?></div>
                                    </div>

                                    <?= Html::a('<i class="material-icons">add_circle_outline</i> Schedule Loan',['client/view','id'=>$client_id], ['class' => 'btn btn-success mb-3 btn-block','style'=>'margin-top:15px;']); ?>
                                        
                                    <ul class="list-group" style=margin-top:20px;>
                                        <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">create</i> Update Profile',['client/update','id'=>$client_id], ['class' => '']); ?>
                                        </b></li>
                                        <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">file_upload</i> Upload profile pic',['client/view','id'=>$client_id], ['class' => '']); ?>
                                        </b></li>
                                        <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">attach_file</i> Attach Document',['client/view','id'=>$client_id], ['class' => '']); ?>
                                        </b></li>
                                        <li class="list-group-item"><b>
                                        <?= Html::a('<i class="material-icons">person</i> Add next of kin',['client/view','id'=>$client_id], ['class' => '']); ?>
                                        </b></li>
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