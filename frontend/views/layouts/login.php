<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use frontend\assets\LayoutAsset;
use yii\helpers\Url;
use quickbooks\models\LeftNavigation;
use yii\helpers\ArrayHelper;

LayoutAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Kumusoft">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="author" content="Kumusoft Solutions">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> |Loan Management System</title>
        <?php $this->head() ?>
        <style>
            html{
                font-size:18px;
            }
        </style>
    </head>
    <body class="login-page">
        <?php $this->beginBody() ?>   
        <div class="login-header box-shadow bg-dark">
            <div class="container-fluid d-flex  align-items-center">
                <div class="brand-logo" style="text-align:left;">
                    <a href="/">
                        <img src="<?= Url::base(true); ?>/img/app-logo.png" alt="" class="pull-left">
                    </a>
                </div>
            </div>
        </div>
        <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center" style="background:#dadde3;">
            <div class="container">
                <div class="row align-items-center">
                
                    <div class="col-md-6 col-lg-12">
                        <div class="login-box bg-white box-shadow border-radius-10">
                            <div class="login-title">
                                <h2 class="text-center text-success"><?= $this->title; ?></h2>
                            </div>
                            <?= $content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>