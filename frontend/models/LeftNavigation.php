<?php

namespace frontend\models;

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
                'label' => 'Main Menu',
                'url' => '#',
                'options' => ['class' => 'nav-label', 'style' => 'margin-top:5px;'],
                'encode' => false,
                'visible' => true
            ],
            
            [
                'label' => '<i class="icon ion-ios-people"></i>Members',
                'url' => ['member/index','id'=>Yii::$app->member->sacco_id],
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
           
         
            [
                'label' => '<i class="icon ion-md-grid"></i> Groups',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
        

            [
                'label' => 'Sacco Products',
                'url' => '#',
                'options' => ['class' => 'nav-label', 'style' => 'margin-top:5px;'],
                'encode' => false,
                'visible' => true
            ],
             [
                'label' => '<i class="typcn typcn-clipboard"></i>Loans',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
              [
                'label' => '<i class="typcn typcn-clipboard"></i>Savings',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
               [
                'label' => '<i class="typcn typcn-clipboard"></i>Shares',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
               [
                'label' => '<i class="typcn typcn-clipboard"></i>Loan Calculator',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
            
            [
                'label' => 'Reports & Statistics',
                'url' => '#',
                'options' => ['class' => 'nav-label', 'style' => 'margin-top:5px;'],
                'encode' => false,
                'visible' => true
            ],
              [
                'label' => '<i class="typcn typcn-chart-bar"></i>All Reports',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
             [
                'label' => '<i class="typcn typcn-chart-bar"></i>Loans Reports',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
              [
                'label' => '<i class="typcn typcn-chart-bar"></i>Savings Reports',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
               [
                'label' => '<i class="typcn typcn-chart-bar"></i>Group Reports',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
               [
                'label' => '<i class="typcn typcn-chart-bar"></i>Data Export',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
            
            [
                'label' => 'Configurations',
                'url' => '#',
                'options' => ['class' => 'nav-label', 'style' => 'margin-top:5px;'],
                'encode' => false,
                'visible' => true
            ],
              [
                'label' => '<i class="icon ion-ios-lock"></i> Access Management',
                'url' => ['user/index','id'=>Yii::$app->member->sacco_id],
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
              [
                'label' => '<i class="icon ion-ios-home"></i>Branches',
                'url' => ['sacco/index','id'=>Yii::$app->member->sacco_id],
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
               [
                'label' => '<i class="icon ion-ios-cart"></i>Products',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'linkOptions' => ['class' => 'nav-link'],
                'encode' => false,
                'visible' => true
            ],
               
               


        ];
    }

}
