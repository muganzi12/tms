<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use frontend\assets\LayoutAsset;
use yii\helpers\Url;
use frontend\models\LeftNavigation;
use yii\helpers\ArrayHelper;

LayoutAsset::register($this);
//Add JQuery to header
$this->registerAssetBundle(yii\web\JqueryAsset::className(), \yii\web\View::POS_HEAD);
Yii::$app->assetManager->forceCopy = true;
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
            ul.kumusoft li.dropdown.open ul.submenu{
                display: block !important;
            }
        </style>
    </head>
    <body>
        <?php $this->beginBody() ?>   
        <div class="header" style="background:#454647">
            <?= $this->render('top_nav'); ?>
        </div>

        <div class="left-side-bar" style="background:#09255c">
            <?= $this->render('left_nav'); ?>
        </div>
        <div class="mobile-menu-overlay"></div>

        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="page-header" style="padding:7px 5px;margin-bottom: 10px;border-radius: 0px;">
                        <div class="row">
                            <div class="col-md-9 col-sm-12">
                                <div class="title">
                                    <h4><?= $this->title; ?></h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 text-right">
                                <?= ArrayHelper::keyExists('topright_button', $this->params) ? Html::a($this->params['topright_button_label'], $this->params['topright_button_link'], ['class' => 'btn ' . $this->params['topright_button_class']]) : ('') ?>  
                            </div>
                        </div>
                    </div>
                    <?php
                    //check if there are nay flush messages
                    $msgs = Yii::$app->session->getAllFlashes();
                    if (count($msgs) > 0) {
                        foreach ($msgs as $key => $message) {
                            echo Alert::widget([
                                'options' => [
                                    'class' => 'alert alert-dismissible show alert-' . $key,
                                    'role' => 'alert'
                                ],
                                'body' => $message,
                                'closeButton' => ['class' => 'close', 'type' => 'button', 'data-dismiss' => 'alert']
                            ]);
                        }
                    }
                    ?>
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                        <?= $content; ?>
                    </div>
                </div>
               
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
