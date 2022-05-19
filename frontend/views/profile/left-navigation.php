<?php
use yii\helpers\Url;
/*
 * Left Navigation on the personal profile page
 */
?>
  <img src="<?= Yii::$app->member->profilePicture; ?>" class="img img-rounded" style="width:100%;"/>
<hr/>
<ul class="sidebar-menu do-nicescrol">
    <li><a href="<?= Url::to(['profile/index']);?>" class="waves-effect"><i class="icon icon-user"></i> <span>My Profile</span> </a></li>
        <li><a href="<?= Url::to(['profile/edit']);?>" class="waves-effect"><i class="icon icon-pencil"></i> <span>Update Profile</span> </a></li>
   
        <li><a href="<?= Url::to(['site/reset-mypasswd']); ?>" class="waves-effect"><i class="zmdi zmdi-lock"></i> <span>Change Password</span></a></li>
   
</ul>
