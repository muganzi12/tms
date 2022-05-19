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
<html lang="<?= Yii::$app->language ?>" dir="ltr">
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
    <body class="layout-login">
    <?php $this->beginBody() ?> 
        <div class="layout-login__overlay"></div>
        <div class="layout-login__form bg-white"
             data-perfect-scrollbar>
            <div class="d-flex justify-content-center mt-2 mb-5 navbar-light">
                <a href="index.html"
                   class="navbar-brand"
                   style="min-width: 0">
                    <img class="navbar-brand-icon"
                         src="<?= Url::base(true);?>/img/demos.png"
                         width="80"
                         alt="Stack">
                    <span></span>
                </a>
            </div>
            
            <p class="mb-5">Login to access your Loan Manager Account </p>
            <?= $content; ?>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>