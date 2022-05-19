<?php

use yii\helpers\Url;
use yii\bootstrap\Nav;
use frontend\models\LeftNavigation;
?>
<div class="mdk-drawer  js-mdk-drawer"
     id="default-drawer"
     data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-p-t"
             data-perfect-scrollbar style="background-color: #949494">
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
</div>