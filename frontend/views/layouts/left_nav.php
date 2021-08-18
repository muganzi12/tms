<?php

use yii\helpers\Url;
use yii\bootstrap\Nav;
use frontend\models\LeftNavigation;

/*
 * Left navigation for logged in members.
 */
?>
<div class="brand-logo">
    <a href="<?= Url::home(); ?>">
        <img src="<?= Url::base(true); ?>/img/app-logo.png" alt="" class="dark-logo">
        <img src="<?= Url::base(true); ?>/img/app-logo.png" alt="" class="light-logo">
    </a>
    <div class="close-sidebar" data-toggle="left-sidebar-close">
        <i class="ion-close-round"></i>
    </div>
</div>
<div class="menu-block">
    <div class="sidebar-menu">
        <?=
        Nav::widget([
            'items' => LeftNavigation::getNavItems(),
            'options' => [
                'class' => ['widget' => 'sidebar-menu'],
                'id' => 'left_nav_menu'
            ],
            'dropDownCaret' => '&nbsp;'
        ]);
        ?>
    </div>
</div>
