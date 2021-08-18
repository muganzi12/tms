<?php

namespace frontend\models;

use Yii;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\helpers\Url;

class LeftNavigation extends Nav {

    /**
     * Nav Items
     */
    public static function getNavItems() {
        return [
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">apps</i> <span class="sidebar-menu-text">Dashboard</span>',
                'url' => ['site/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">assignment_ind</i> <span class="sidebar-menu-text">Clients</span>',
                'url' => ['client/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">event_seat</i> <span class="sidebar-menu-text">Investors</span>',
                'url' => ['investor/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
            "<li class='sidebar-menu-item'>
                    <a class='sidebar-menu-button'  data-toggle='collapse' href='#loans_menu'>
                        <i class='sidebar-menu-icon sidebar-menu-icon--left material-icons'>assignment</i>
                        <span class='sidebar-menu-text'>Loan Applications</span>
                        <span class='ml-auto sidebar-menu-toggle-icon'></span>
                    </a>
                    <ul class='sidebar-submenu collapse' id='loans_menu'>
                            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'>Pending Approval</span>", ['loan/index'], ['class' => 'sidebar-menu-button'])
            . "</li>
                            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'>Approved</span>", ['loan/approved-loan-applications'], ['class' => 'sidebar-menu-button'])
            . "</li>
                            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'>Disbursed Loans</span>", ['loan/disbursed-loan-applications'], ['class' => 'sidebar-menu-button'])
            . "</li>
                            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'>Rejected Applications</span>", ['loan/rejected-loan-applications'], ['class' => 'sidebar-menu-button'])
            . "</li>
                            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'>Due this Month</span>", ['#'], ['class' => 'sidebar-menu-button'])
            . "</li>
                            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'>All active loans</span>", ['#'], ['class' => 'sidebar-menu-button'])
            . "</li>
                            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'>Fully paid loans</span>", ['#'], ['class' => 'sidebar-menu-button'])
            . "</li>
                    </ul>
                </li>",
            "<div class='sidebar-heading'>SETTINGS</div>",
            "<li class='sidebar-menu-item'>
                    <a class='sidebar-menu-button'  data-toggle='collapse' href='#chart_of_accounts'>
                        <i class='sidebar-menu-icon sidebar-menu-icon--left material-icons'>border_all</i>
                        <span class='sidebar-menu-text'>Chart of Accounts</span>
                        <span class='ml-auto sidebar-menu-toggle-icon'></span>
                    </a>
                    <ul class='sidebar-submenu collapse' id='chart_of_accounts'>
                            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'>List of accounts</span>", ['account/index'], ['class' => 'sidebar-menu-button'])
            . "</li>
                            <li class='sidebar-menu-item'>"
            . Html::a("<span class='sidebar-menu-text'>In-active Accounts</span>", ['#'], ['class' => 'sidebar-menu-button'])
            . "</li>
                    </ul>
                </li>",
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">folder_open</i> <span class="sidebar-menu-text">Loan Products</span>',
                'url' => ['loan-product/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_balance</i> <span class="sidebar-menu-text">Branches</span>',
                'url' => ['branch/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i> <span class="sidebar-menu-text">System User Accounts</span>',
                'url' => ['user/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">view_compact</i> <span class="sidebar-menu-text">User Groups</span>',
                'url' => ['user/user-groups'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
        ];
    }

}
