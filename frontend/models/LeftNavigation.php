<?php

namespace frontend\models;

use yii\bootstrap\Nav;
use yii\helpers\Html;

class LeftNavigation extends Nav
{

    /**
     * Nav Items
     */
    public static function getNavItems()
    {
        return [
            "<div class='sidebar-heading' style='margin-top:20px;color:#0d0d0d;'>DASHBOARDS</div><hr>",
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#0d0d0d;">apps</i> <span style="color:#525151">Dashboard</span>',
                'url' => ['site/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false,
            ],

            "<div class='sidebar-heading' style='margin-top:20px;color:#0d0d0d'>Property Management</div> <hr>",
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#525151;">dns</i> <span style="color:#525151;">Properties</span>',
                'url' => ['property/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false,
            ],

            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#525151;">dns</i> <span style="color:#525151;">Property Units</span>',
                'url' => ['property-unit/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false,
            ],

            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#525151;">event_note</i> <span style="color:#525151;">Maintenance Request</span>',
                'url' => ['maintenance-request/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false,
            ],

            "<div class='sidebar-heading' style='margin-top:20px;color:#0d0d0d'>Account Management</div> <hr>",
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#525151;">assignment_ind</i> <span style="color:#525151;">User Management</span>',
                'url' => ['user/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false,
            ],

            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#525151;">perm_phone_msg</i> <span style="color:#525151;">Roles</span>',
                'url' => ['role/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false,
            ],

            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#525151;">ac_unit</i> <span style="color:#525151;">Permissions</span>',
                'url' => ['auth-item/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false,
            ],

            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#525151;">ac_unit</i> <span style="color:#525151;">Assignments</span>',
                'url' => ['auth-assignment/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false,
            ],

            "<div class='sidebar-heading' style='margin-top:20px;color:#0d0d0d'>Tenants Management</div> <hr>",
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#525151;">assignment_ind</i> <span style="color:#525151;">Tenants</span>',
                'url' => ['user/tenants'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false,
            ],
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#525151;">account_balance_wallet</i> <span style="color:#525151;">Property Managers</span> ',
                'url' => ['investor/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false,
            ],
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons" style="color:#525151;">account_balance</i> <span style="color:#525151;">Property Owners</span>',
                'url' => ['loan/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false,
            ],

            "<div class='sidebar-heading' style='margin-top:20px;color:#0d0d0d;'>Reports & Settings</div> <hr>",

            "<li class='sidebar-menu-item'>
                <a class='sidebar-menu-button'  data-toggle='collapse' href='#loan_principal'>
                    <i class='sidebar-menu-icon sidebar-menu-icon--left material-icons' style='color:#525151;'>payment</i>
                    <span class='sidebar-menu-text' style='color:#525151;'>Properties</span>
                    <span class='ml-auto sidebar-menu-toggle-icon' style='color:#525151;'></span>
                </a>
                <ul class='sidebar-submenu collapse' id='loan_principal'>
                        <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text' style='color:#525151;'>Principal Due</span>", ['loan/principal-due-payments'], ['class' => 'sidebar-menu-button'])
            . "</li>
          <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'style='color:#525151;'>Principal Paid</span>", ['loan/principal-paid-payments'], ['class' => 'sidebar-menu-button'])
            . "</li>


                </ul>
            </li>",

            "<li class='sidebar-menu-item'>
                <a class='sidebar-menu-button'  data-toggle='collapse' href='#loan_payment'>
                    <i class='sidebar-menu-icon sidebar-menu-icon--left material-icons' style='color:#525151;'>payment</i>
                    <span class='sidebar-menu-text' style='color:#525151;'>Tenants</span>
                    <span class='ml-auto sidebar-menu-toggle-icon' style='color:#525151;'></span>
                </a>
                <ul class='sidebar-submenu collapse' id='loan_payment'>
                        <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text' style='color:#525151;'>Interest Due</span>", ['loan/interest-due-payments'], ['class' => 'sidebar-menu-button'])
            . "</li>
          <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'style='color:#525151;'>Interest Paid</span>", ['loan/interest-paid-payments'], ['class' => 'sidebar-menu-button'])
            . "</li>
             <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'style='color:#525151;'>Suspended Interest</span>", ['loan/suspended-interest-payments'], ['class' => 'sidebar-menu-button'])
            . "</li>

                </ul>
            </li>",

            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons"  style="color:#525151;">receipt</i> <span class="sidebar-menu-text" style="color:#525151;">Summarry Report</span>',
                'url' => ['loan/ledger-report'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                // 'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false,
            ],

            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons"  style="color:#525151;">settings</i> <span  style="color:#525151;" class="sidebar-menu-text">System Settings</span>',
                'url' => ['site/admin'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                //    'visible' => Yii::$app->user->can('Administrator'),
                'encode' => false,
            ],

            "<li class='sidebar-menu-item'>
            <a class='sidebar-menu-button'  data-toggle='collapse' href='#master_data'>
                <i class='sidebar-menu-icon sidebar-menu-icon--left material-icons' style='color:#525151;'>payment</i>
                <span class='sidebar-menu-text' style='color:#525151;'>Master Data</span>
                <span class='ml-auto sidebar-menu-toggle-icon' style='color:#525151;'></span>
            </a>
            <ul class='sidebar-submenu collapse' id='master_data'>
                    <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text' style='color:#525151;'>Districts</span>", ['district/index'], ['class' => 'sidebar-menu-button'])
            . "</li>
      <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'style='color:#525151;'>Divisions</span>", ['district/index'], ['class' => 'sidebar-menu-button'])
            . "</li>
            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'style='color:#525151;'>Parishes</span>", ['parish/index'], ['class' => 'sidebar-menu-button'])
            . "</li>
            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'style='color:#525151;'>Villages</span>", ['village/index'], ['class' => 'sidebar-menu-button'])
            . "</li>
            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'style='color:#525151;'>Streets</span>", ['street/index'], ['class' => 'sidebar-menu-button'])
            . "</li>

            </ul>
        </li>",

        ];
    }

}
