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
                'label' => '<span class="micon dw dw-home"></span><span class="mtext">Dashboard</span>',
                'url' => ['site/index'],
                'linkOptions' => ['class' => 'dropdown-toggle no-arrow'],
                'encode' => false
            ],
            [
                'label' => '<span class="micon dw dw-list"></span><span class="mtext">Clients</span>',
                'url' => ['client/index'],
                'linkOptions' => ['class' => 'dropdown-toggle no-arrow'],
                'encode' => false
            ],
            [
                'label' => '<span class="micon dw dw-list"></span><span class="mtext">Loans</span>',
                'items' => [
                    [
                        'label' => 'Loan Applications',
                        'url' => ['loan/index'],
                        'visible' => true
                    ],
                ],
                'encode' => false,
                'dropDownOptions' => ['class' => ['widget' => 'submenu']]
            ],
            [
                'label' => '<span class="micon dw dw-list"></span><span class="mtext">Chart of Accounts</span>',
                'items' => [
                    [
                        'label' => 'Accounts',
                        'url' => ['account/index'],
                        'visible' => true
                    ],
                    [
                        'label' => 'Loan Products',
                        'url' => ['loan-product/index']
                    ],
                ],
                'encode' => false,
                'dropDownOptions' => ['class' => ['widget' => 'submenu']]
            ],
            [
                'label' => '<span class="micon dw dw-notebook"></span><span class="mtext">Reports</span>',
                'items' => [
                    [
                        'label' => 'Pending Loans',
                        'url' => ['loan/index'],
                        'visible' => true
                    ],
                    [
                        'label' => 'Approved Loans',
                        'url' => ['loan/approved-loan-applications'],
                        'visible' => true
                    ],
                    [
                        'label' => 'Rejected Loans',
                        'url' => ['loan/rejected-loan-applications'],
                        'visible' => true
                    ],
                    [
                        'label' => 'Disbursed Loans',
                        'url' => ['loan/disbursed-loan-applications'],
                        'visible' => true
                    ],
                ],
                'encode' => false,
                'dropDownOptions' => ['class' => ['widget' => 'submenu']]
            ],
            [
                'label' => "<span class='micon dw dw-building'></span><span class='mtext'>Configurations</span>",
                'items' => [
                    [
                        'label' => 'Branches',
                        'url' => ['branch/index']
                    ],
                    [
                        'label' => 'System Users',
                        'url' => ['user/index'],
                        'visible' => true
                    ],
                    [
                        'label' => 'User Groups',
                        'url' => ['user/user-groups'],
                        'visible' => true
                    ],
                ],
                'encode' => false,
                'dropDownOptions' => ['class' => ['widget' => 'submenu']]
            ],
        ];
    }

}
