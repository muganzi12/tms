<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\ButtonDropdown;

/*
 * To Navigation
 */
?>
<div class="container-fluid">
    <div class="az-header-left">
        <a href="" id="azSidebarToggle" class="az-header-menu-icon"><span></span></a>
    </div><!-- az-header-left -->
   
    <div class="az-header-center">
    </div><!-- az-header-center -->
    <div class="az-header-right">
  
        <div class="dropdown az-profile-menu">
            <a href="" class="az-img-user"><img src="<?= Yii::$app->member->profilePicture; ?>" alt=""></a>
            <div class="dropdown-menu">
                <div class="az-dropdown-header d-sm-none">
                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
            
                <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
                <a href="<?= Url::to(['site/logout']); ?>" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
            </div><!-- dropdown-menu -->
        </div>
    </div><!-- az-header-right -->
</div><!-- container -->