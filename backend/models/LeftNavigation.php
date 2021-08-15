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
                'label' => '<span class="micon dw dw-home"></span><span class="mtext">Dashboard</span>',
                'url' => ['site/index'],
                'linkOptions' => ['class' => 'dropdown-toggle no-arrow'],
                'encode' => false
            ],
            [
                'label' => '<span class="micon dw dw-list"></span><span class="mtext">Companies</span>',
                'url' => ['company/index'],
                'linkOptions' => ['class' => 'dropdown-toggle no-arrow'],
                'encode' => false
            ],
            [
                'label' => '<span class="micon dw dw-list"></span><span class="mtext">Chart of Accounts</span>',
                'items' => [
                    [
                        'label' => 'Accounts',
                        'url' => ['account/index'],
                        'visible' => true
                    ],
                ],
                'encode' => false,
                'dropDownOptions' => ['class' => ['widget' => 'submenu']]
            ],
            [
                'label' => "<span class='micon dw dw-building'></span><span class='mtext'>Account Management</span>",
                'items' => [
                    [
                        'label' => 'Super System Admins',
                        'url' => ['user/super-admin'],
                        'visible' => true
                    ],
                    [
                        'label' => 'Company System Admins',
                        'url' => ['user/client-admin'],
                        'visible' => true
                    ],
                ],
                'encode' => false,
                'dropDownOptions' => ['class' => ['widget' => 'submenu']]
            ],
        ];
    }

}
