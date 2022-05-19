<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use frontend\assets\NewAsset;
use yii\helpers\Url;
use frontend\models\LeftNavigationOfficer;
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

    <body>    
        <?php $this->beginBody() ?> 
        <div class="preloader bg-white"></div>
        <!-- Header Layout -->
        <div class="mdk-header-layout js-mdk-header-layout">
            <!-- Header -->
            <?= $this->render('new_topnav'); ?>
            <!-- // END Header -->

            <!-- Header Layout Content -->
            <div class="mdk-header-layout__content">

                <div class="mdk-drawer-layout js-mdk-drawer-layout"
                     data-push
                     data-responsive-width="992px">
                    <div class="mdk-drawer-layout__content page">

                        <div class="container-fluid page__heading-container">
                            <div class="page__heading d-flex align-items-center">
                                <div class="flex">
                                    <h1 class="m-0"><?= $this->title; ?></h1>
                                </div>
                                <?= ArrayHelper::keyExists('topright_button', $this->params) ? Html::a($this->params['topright_button_label'], $this->params['topright_button_link'], ['class' => 'btn ' . $this->params['topright_button_class']]) : ('') ?> 
                            </div>
                        </div>

                        <div class="container-fluid page__container">
                            <?= $content; ?>
                        </div>

                    </div>
                    <!-- // END drawer-layout__content -->
                    <?= $this->render('officer_leftnav'); ?>
                </div>
                <!-- // END drawer-layout -->

            </div>
            <!-- // END header-layout__content -->

        </div>
        <!-- // END header-layout -->

        <!-- App Settings FAB -->
         <div id="app-settings" style="display: none;">
            <app-settings layout-active="default">    
            </app-settings>
        </div>  <div id="app-settings">
            <app-settings layout-active="default">    
            </app-settings>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>