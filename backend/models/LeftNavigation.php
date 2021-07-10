<?php

namespace backend\models;

use Yii;
use yii\helpers\Html;
use yii\bootstrap\Nav;

class LeftNavigation extends Nav {

    /**
     * Nav Items
     */
    public static function getNavItems() {
        return [
          
            [
                'label' => '<i class="icon ion-ios-list"></i> Members',
                'url' => ['member/index'],
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
        
           
            [
                'label' => '<i class="typcn typcn-book"></i>Branches',
                'url' => ['branch/index'],
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
            //Profile
            [
                'label' => 'Account Management',
                'options' => ['class' => 'sub-header']
            ],
            [
                'label' => '<i class="icon ion-ios-person"></i>System Users',
                'url' => ['user/index'],
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
            [
                'label' => '<i class="typcn typcn-user-outline"></i>Update Profile',
                'url' => ['profile/edit'],
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
            [
                'label' => '<i class="icon ion-ios-list"></i>Change Password',
                'url' => ['site/reset-mypasswd'],
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
            [
                'label' => '<i class="icon ion-ios-list"></i>Change Profile Picture',
                'url' => ['profile/upload-pic'],
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
          
        ];
    }

}
