<?php

use yii\helpers\Url;
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<div class="app-email-w" style='padding-top: 0px;'>
    <div class="app-email-i">
        <div class="ae-side-menu">
            <ul class="ae-main-menu" style='width:230px;'>
                <div style='padding-bottom: 5px;'>
                    <img src='/activitytracker/web/html-assets/light/img/avatar1.jpg' class='img img-rounded' style='border:3px solid #eee; border-radius: 10px;'/>
                </div>
                <li class="">
                    <a href="<?= Url::to(['activity/new-activity'])?>"><i class="os-icon os-icon-ui-22"></i><span>New Assignment</span></a>
                </li>
                <li>
                    <a href="#"><i class="os-icon os-icon-documents-13"></i><span>My Projects</span></a>
                </li>
                <li>
                    <a href="#"><i class="os-icon os-icon-share-2"></i><span>Shared Tasks</span></a>
                </li>
                <li>
                    <a href="#"><i class="os-icon os-icon-user-male-circle"></i><span>Update Profile</span></a>
                </li>
            </ul>
        </div>
        <div class="ae-content-w" style='padding-left:4px;'>
            <?= $this->render('_top-profile-nav'); ?>
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>