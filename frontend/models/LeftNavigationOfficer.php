<?php

namespace frontend\models;

use Yii;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\helpers\Url;

class LeftNavigationOfficer extends Nav {

    /**
     * Nav Items
     */
    public static function getNavItems() {
        return [
            "<div class='sidebar-heading' style='margin-top:20px;color:#0d0d0d;'>DASHBOARDS</div><hr>",
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#0d0d0d;">dashboard</i> <span style="color:#0d0d0d">Dashboard</span>',
                'url' => ['site/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
         
            "<div class='sidebar-heading' style='margin-top:20px;color:#0d0d0d'>Loans Management</div> <hr>",
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#0d0d0d;">group</i> <span style="color:#0d0d0d;">Clients</span>',
                'url' => ['client/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false
            ],
            
              [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#0d0d0d;">account_balance</i> <span style="color:#0d0d0d;">Loans</span>',
                'url' => ['loan/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false
            ],
            
               [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#0d0d0d;">account_balance</i> <span style="color:#0d0d0d;">Portfolio</span>',
                'url' => ['loan/loan-portifolio'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false
            ],
   
        
            "<div class='sidebar-heading' style='margin-top:20px;color:#0d0d0d;'>Loans Checker</div> <hr>",
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#0d0d0d;">chevron_right</i> <span style="color:#0d0d0d;">Submitted applications</span>',
                'url' => ['loan/pending-loan-applications'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
            
              [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#0d0d0d;">beenhere</i> <span style="color:#0d0d0d;">Approved loans</span>',
                'url' => ['loan/approved-loan-applications'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
    
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#0d0d0d;">spellcheck</i> <span style="color:#0d0d0d;">Disbursed loans</span>',
                'url' => ['loan/disbursed-loan-applications'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
                           [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#0d0d0d;">payment</i> <span style="color:#0d0d0d;">Fully paid loans</span>',
                'url' => ['loan/paid-loan-applications'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false
            ],
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#0d0d0d;">cancel</i> <span style="color:#0d0d0d;">Returned for  works</span>',
                'url' => ['loan/returned-loan-applications'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
            "<div class='sidebar-heading' style='margin-top:20px;color:#0d0d0d;'>Reports & Settings</div> <hr>",
                    
            "<li class='sidebar-menu-item'>
                <a class='sidebar-menu-button'  data-toggle='collapse' href='#loan_principal'>
                    <i class='sidebar-menu-icon sidebar-menu-icon--left material-icons' style='color:#0d0d0d;'>tune</i>
                    <span class='sidebar-menu-text' style='color:#0d0d0d;'>Principal</span>
                    <span class='ml-auto sidebar-menu-toggle-icon' style='color:#0d0d0d;'></span>
                </a>
                <ul class='sidebar-submenu collapse' id='loan_principal'>
                        <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text' style='color:#0d0d0d;'>Principal Due</span>", ['loan/principal-due-payments'], ['class' => 'sidebar-menu-button'])
            . "</li>
          <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'style='color:#0d0d0d;'>Principal Paid</span>", ['loan/principal-paid-payments'], ['class' => 'sidebar-menu-button'])
            . "</li>
   
         
                </ul>
            </li>",
            
                  "<li class='sidebar-menu-item'>
                <a class='sidebar-menu-button'  data-toggle='collapse' href='#loan_payment'>
                    <i class='sidebar-menu-icon sidebar-menu-icon--left material-icons' style='color:#0d0d0d;'>sort</i>
                    <span class='sidebar-menu-text' style='color:#0d0d0d;'>Interest</span>
                    <span class='ml-auto sidebar-menu-toggle-icon' style='color:#0d0d0d;'></span>
                </a>
                <ul class='sidebar-submenu collapse' id='loan_payment'>
                        <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text' style='color:#0d0d0d;'>Interest Due</span>", ['loan/interest-due-payments'], ['class' => 'sidebar-menu-button'])
            . "</li>
          <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'style='color:#0d0d0d;'>Interest Paid</span>", ['loan/interest-paid-payments'], ['class' => 'sidebar-menu-button'])
            . "</li>
             <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'style='color:#0d0d0d;'>Suspended Interest</span>", ['loan/suspended-interest-payments'], ['class' => 'sidebar-menu-button'])
            . "</li>
    
                </ul>
            </li>",
            
            
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons"  style="color:#0d0d0d;">receipt</i> <span class="sidebar-menu-text" style="color:#0d0d0d;">Summarry Report</span>',
                'url' => ['loan/ledger-report'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
               [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons"  style="color:#0d0d0d;">receipt</i> <span class="sidebar-menu-text" style="color:#0d0d0d;">Aging Report</span>',
                'url' => ['loan/loan-aging-report'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
               // 'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false
            ],
        
         
        ];
    }

}
