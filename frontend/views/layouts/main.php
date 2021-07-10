<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;

AppAsset::register($this);
//$this->registerAssetBundle(yii\web\JqueryAsset::className(), \yii\web\View::POS_HEAD);
?>
<!DOCTYPE html>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Kumusoft">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="author" content="Kumusoft Solutions">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | SACCO APP</title>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <?php $this->head() ?>
        <style>
            html{
                font-size:18px;
            }
        </style>
        <!--<script src="<?php //= Url::home();   ?>/public_html/html-assets/lib/jquery/jquery.min.js"></script>-->
    </head>
    <body class="az-body az-body-sidebar az-light">
        <?php $this->beginBody() ?>
        <div class="az-sidebar">
            <div class="az-sidebar-body">
                <?= $this->render('blocks/left-nav'); ?>
            </div>
        </div>
        <div class="az-content az-content-dashboard-five">
            <div class="az-header" >
                <?= $this->render('blocks/top-nav'); ?>
            </div>
            <?php if(!ArrayHelper::isIn('hide_page_title', $this->params)){ ?>
            <div class="az-content-header d-block d-md-flex">
                <div>
                    <h2 class="az-content-title tx-24 mg-b-5"><?= $this->title; ?></h2>
                    <p class="mg-b-0"><?= $this->params['page_description'] ?></p>
                </div>
            </div>
            <?php } ?>
            <div class="az-content-body">
                <?php
                //check if there are nay flush messages
                $msgs = Yii::$app->session->getAllFlashes();
                if (count($msgs) > 0) {
                    foreach ($msgs as $key => $message) {
                        $class = 'alert alert-' . $key;
                        echo Alert::widget([
                            'options' => [
                                'class' => $class,
                                'role' => 'alert'
                            ],
                            'body' => $message,
                            'closeButton' => ['class' => 'close', 'type' => 'button', 'data-dismiss' => 'alert']
                        ]);
                    }
                }
                ?> 
                <?= $content; ?>
            </div>

            <div class="az-footer ht-40">
                <div class="container-fluid pd-t-0-f ht-100p">
                    <span>&copy; 2021 Kumusoft Solutions Ltd</span>
                </div><!-- container -->
            </div><!-- az-footer -->
        </div>
     
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
