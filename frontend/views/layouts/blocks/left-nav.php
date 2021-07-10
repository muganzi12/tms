<?php

use yii\helpers\Url;
use yii\bootstrap\Nav;
use frontend\models\LeftNavigation;

/*
 * Left navigation for logged in members.
 */
?>
<div class="az-sidebar-header" style="padding:0px;">
     <a href="<?= Yii::getAlias('@web'); ?>">
   <h6><b><?= strtoupper(Yii::$app->member->sacco->name); ?></b></h6>
     </a>
</div>
<div class="menu-block">
    <div class="sidebar-menu">
        <?=
        Nav::widget([
            'items' => LeftNavigation::getNavItems(),
            'options' => [
                'class' => ['widget' => 'nav'],
                'id' => 'left_nav_menu'
            ],
            'dropDownCaret' => '&nbsp;',
            'activateItems'=>true
        ]);
        ?>
    </div>
</div>
