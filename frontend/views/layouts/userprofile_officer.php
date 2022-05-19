<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

$user_id = $this->params['user_id'];

$user = User::findOne($user_id);
?>
<?php $this->beginContent('@frontend/views/layouts/main-blank.php'); ?>
<div class="mdk-header-layout__content">
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page">
            <div style="padding-bottom: calc(5.125rem / 2); position: relative; margin-bottom: 1.5rem;">
                 <div class="bg-dark" style="min-height: 40px;  background: linear-gradient(to right, #8dbef2, #77c6ed) !important;">
                    <div class="d-flex align-items-end container-fluid page__container" style="position: absolute; left: 0; right: 0; bottom: 0;">
                        <div class="avatar avatar-xl">
                            <img src="<?= $user->profilePicture; ?>" alt="avatar" class="avatar-img rounded-circle">
                        </div>
                        <div class="card-header card-header-tabs-basic nav flex" role="tablist">
                            <?= Html::a('Profile', ['user/view', 'id' => $user_id], ['class' => 'active']); ?>
                            <?= Html::a('Activity Logs', ['user/activity-logs', 'id' => $user_id], ['class' => '']); ?>      
                        </div>
                   
                    </div>
                </div>
            </div>
            <div class="container-fluid page__container">
                <div class="row">
                    <div class="col-lg-3" style="border-right:1px solid #eee;">
                        <h1 class="h4 mb-1"><?= $user->firstname . ' ' . $user->lastname; ?></h1>

                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">local_phone</i>
                            <div class="flex"><?= $user->telephone; ?></div>
                        </div>
                        <div class="text-muted d-flex align-items-center">
                            <i class="material-icons mr-1">mail_outline</i>
                            <div class="flex"><a href="mailto:<?= $user->email; ?>"><?= $user->email; ?></a></div>
                        </div>

                        <ul class="list-group" style=margin-top:20px;>
                            <li class="list-group-item"><b>
                                    <?= Html::a('<i class="material-icons">create</i> Update Profile', ['user/update', 'id' => $user_id], ['class' => '']); ?>
                                </b></li>
                            <li class="list-group-item"><b>
                                    <?= Html::a('<i class="material-icons">file_upload</i> Upload profile pic', ['user/upload-pic', 'id' => $user_id], ['class' => '']); ?>
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
        <?= $this->render('officer_leftnav'); ?>
    </div>
    <!-- // END drawer-layout -->

</div>
<!-- // END header-layout__content -->
<?php $this->endContent(); ?>