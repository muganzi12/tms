<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use frontend\assets\LayoutAsset;
use yii\helpers\Url;
use frontend\models\LeftNavigation;

LayoutAsset::register($this);
//Add JQuery to header
$this->registerAssetBundle(yii\web\JqueryAsset::className(), \yii\web\View::POS_HEAD);
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="EFRIS, URA, Kumusoft">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="author" content="Kumusoft Solutions">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | Kakasa Client Portal</title>
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

    <body class="sidebar-dark">
        <?php $this->beginBody() ?>   
           <div class="header" style="background:#454647">
            <?= $this->render('top_nav'); ?>
        </div>
         <div class="left-side-bar" style="background:#09255c">
            <?= $this->render('left_nav'); ?>
        </div>
        <div class="mobile-menu-overlay"></div>
        <div class="main-container">
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

            <?= $content; ?>
       
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
