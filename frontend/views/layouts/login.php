<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\LoginAsset;
use yii\helpers\Url;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="fontawesome-i2svg-active fontawesome-i2svg-complete">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | SACCO Admin</title>
        <?php $this->head() ?>
        <script defer src="assets/fontawesome/js/all.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap" rel="stylesheet">
        <style>
            html{
                font-size:15px;
            }
        </style>
     
    </head>
    <body class="docs-page" style='background:#7ab8f5;'>
        <?php $this->beginBody() ?>
    
        <?php
            echo $content;
        ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
