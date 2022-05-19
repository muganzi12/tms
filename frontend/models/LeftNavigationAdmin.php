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
            "<div class='sidebar-heading' style='margin-top:20px;'>DASHBOARDS</div>",
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">perm_identity</i> <span class="sidebar-menu-text">Membership</span>',
                'url' => ['site/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
            // [
            //     'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">attach_money</i> <span class="sidebar-menu-text">Cash Book</span>',
            //     'url' => ['site/cashbook'],
            //     'linkOptions' => ['class' => 'sidebar-menu-button'],
            //     'encode' => false
            // ],
            "<div class='sidebar-heading' style='margin-top:20px;'>LOANS MANAGEMENT</div>",
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">assignment_ind</i> <span class="sidebar-menu-text">Clients</span>',
                'url' => ['client/index'],
                'linkOptions' => ['class' => 'sidebar-menu-button'],
                'encode' => false
            ],
            [
                'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">event_seat</i> <span class="sidebar-menu-text">Investors</span>',
                'url' => ['client/investors'],
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
                    </ul>
                </li>",
                "<li class='sidebar-menu-item'>
                <a class='sidebar-menu-button'  data-toggle='collapse' href='#loan_payment'>
                    <i class='sidebar-menu-icon sidebar-menu-icon--left material-icons'>payment</i>
                    <span class='sidebar-menu-text'>Loan Payments</span>
                    <span class='ml-auto sidebar-menu-toggle-icon'></span>
                </a>
                <ul class='sidebar-submenu collapse' id='loan_payment'>
                        <li class='sidebar-menu-item'>"
        . Html::a("<span class='sidebar-menu-text'>Overdue Payment</span>", ['#'], ['class' => 'sidebar-menu-button'])
        . "</li>
                        <li class='sidebar-menu-item'>"
        . Html::a("<span class='sidebar-menu-text'>Due this week</span>", ['#'], ['class' => 'sidebar-menu-button'])
        . "</li>
                        <li class='sidebar-menu-item'>"
        . Html::a("<span class='sidebar-menu-text'>Due this week</span>", ['#'], ['class' => 'sidebar-menu-button'])
        . "</li>
                        <li class='sidebar-menu-item'>"
        . Html::a("<span class='sidebar-menu-text'>Paid this week</span>", ['#'], ['class' => 'sidebar-menu-button'])
        . "</li>
                        <li class='sidebar-menu-item'>"
        . Html::a("<span class='sidebar-menu-text'>Paid this month</span>", ['#'], ['class' => 'sidebar-menu-button'])
        . "</li>
                        <li class='sidebar-menu-item'>"
        . Html::a("<span class='sidebar-menu-text'>Defective loans</span>", ['#'], ['class' => 'sidebar-menu-button'])
        . "</li>
                        <li class='sidebar-menu-item'>"
        . Html::a("<span class='sidebar-menu-text'>Fully paid loans</span>", ['#'], ['class' => 'sidebar-menu-button'])
        . "</li>
                </ul>
            </li>",
       
            //"<div class='sidebar-heading' style='margin-top:20px;'>ACCOUNT BOOK</div>",
            // [
            //     'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_balance_wallet</i> <span class="sidebar-menu-text">Income</span>',
            //     'url' => ['#'],
            //     'linkOptions' => ['class' => 'sidebar-menu-button'],
            //     'encode' => false
            //  ],
            //  [
            //     'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">apps</i> <span class="sidebar-menu-text">Capital</span>',
            //     'url' => ['#'],
            //     'linkOptions' => ['class' => 'sidebar-menu-button'],
            //     'encode' => false
            //  ],
            //  [
            //     'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">featured_video</i> <span class="sidebar-menu-text">Liabilities</span>',
            //     'url' => ['#'],
            //     'linkOptions' => ['class' => 'sidebar-menu-button'],
            //     'encode' => false
            //  ],
            //  [
            //     'label' => '<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">date_range</i> <span class="sidebar-menu-text">Expenses</span>',
            //     'url' => ['#'],
            //     'linkOptions' => ['class' => 'sidebar-menu-button'],
            //     'encode' => false
            //  ],
        ];
    }

}
