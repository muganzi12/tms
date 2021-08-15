<?php

use yii\helpers\Url;
use yii\helpers\Html;

/*
 * Top navigation
 */
?>
<div class="header-left">
    <div class="menu-icon dw dw-menu"></div>
    <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
    <div style="font-size:20;font-weight: 800;margin-left:10px;color:#fff;">Loan Management System</div>
</div>
<div class="header-right">
    <div class="user-info-dropdown">
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                <span class="user-icon">
                     <img src="<?= Yii::$app->member->profilePicture; ?>" alt="">
                </span>
                <span class="user-name" style="color:#fff;"><?= Yii::$app->member->fullnames; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="<?= Url::to(['profile/index']);?>"><i class="dw dw-user"></i>My Profile</a>
                <a class="dropdown-item" href="<?= Url::to(['site/reset-mypasswd']); ?>"><i class="dw dw-lock"></i>Change Pasword</a>
                
                <a class="dropdown-item" href="<?= Url::to(['site/logout']); ?>"><i class="dw dw-logout"></i> Log Out</a>
            </div>
        </div>
    </div>
</div>