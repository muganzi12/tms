<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use frontend\assets\NewAsset;
use yii\helpers\Url;
use frontend\models\LeftNavigation;
use yii\helpers\ArrayHelper;

NewAsset::register($this);
//Add JQuery to header
$this->registerAssetBundle(yii\web\JqueryAsset::className(), \yii\web\View::POS_HEAD);
Yii::$app->assetManager->forceCopy = true;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | Loan Management System</title>
        <?php $this->head() ?>
        <style>
            html{
                font-size:16px;
            }
        </style>
    </head>

    <body class="layout-default">    
        <?php $this->beginBody() ?> 
        <div class="preloader"></div>
        <!-- Header Layout -->
        <div class="mdk-header-layout js-mdk-header-layout">
            <?= $this->render('new_topnav'); ?>
            <?= $content; ?>
        </div>
        <!-- // END header-layout -->

        <!-- App Settings FAB -->
        <div id="app-settings">
            <app-settings layout-active="default">    
            </app-settings>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>