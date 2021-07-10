<?php
use backend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
//$this->registerAssetBundle(yii\web\JqueryAsset::className(), \yii\web\View::POS_HEAD);
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="KMS">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="author" content="Kumusoft Solutions">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | SACCO ADMIN PANEL</title>
        <?php $this->head() ?>
        <style>
            html{
                font-size:18px;
            }
        </style>
        <script src="<?= Url::home(); ?>/public_html/html-assets/lib/jquery/jquery.min.js"></script>
    </head>

    <body class="az-body az-body-sidebar az-dashboard-eight">
        <?php $this->beginBody() ?>   
        <div class="az-sidebar">
            <div class="az-sidebar-header">
                <a href="<?= Url::home(); ?>" class="az-logo">ADMIN PANEL</a>
            </div><!-- az-sidebar-header -->
            <div class="az-sidebar-body">
                <?= $this->render('loggedin-left-nav'); ?>
            </div><!-- az-sidebar-body -->
        </div><!-- az-sidebar -->
        <div class="az-content az-content-dashboard-five">
           <div class="az-header az-header-primary" style="background: #003399">
                <div class="container-fluid">
                    <div class="az-header-left">
                        <a href="" id="azSidebarToggle" class="az-header-menu-icon"><span></span></a>
                    </div><!-- az-header-left -->
                    <div class="az-header-center">
                        <input type="search" class="form-control" placeholder="Search for anything...">
                        <button class="btn"><i class="fas fa-search"></i></button>
                    </div><!-- az-header-center -->
                    <div class="az-header-right">
                        <div class="az-header-message">
                            <a href="app-chat.html"><i class="typcn typcn-messages"></i></a>
                        </div><!-- az-header-message -->
                        <div class="dropdown az-header-notification">
                            <a href="" class="new"><i class="typcn typcn-bell"></i></a>
                            <div class="dropdown-menu">
                                <div class="az-dropdown-header mg-b-20 d-sm-none">
                                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                                </div>
                                <h6 class="az-notification-title">Notifications</h6>
                                <p class="az-notification-text">You have 2 unread notification</p>
                                <div class="az-notification-list">
                                    <div class="media new">
                                        <div class="az-img-user"><img src="../img/faces/face2.jpg" alt=""></div>
                                        <div class="media-body">
                                            <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                                            <span>Mar 15 12:32pm</span>
                                        </div><!-- media-body -->
                                    </div><!-- media -->
                                    <div class="media new">
                                        <div class="az-img-user online"><img src="../img/faces/face3.jpg" alt=""></div>
                                        <div class="media-body">
                                            <p><strong>Joyce Chua</strong> just created a new blog post</p>
                                            <span>Mar 13 04:16am</span>
                                        </div><!-- media-body -->
                                    </div><!-- media -->
                                    <div class="media">
                                        <div class="az-img-user"><img src="../img/faces/face4.jpg" alt=""></div>
                                        <div class="media-body">
                                            <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                                            <span>Mar 13 02:56am</span>
                                        </div><!-- media-body -->
                                    </div><!-- media -->
                                    <div class="media">
                                        <div class="az-img-user"><img src="../img/faces/face5.jpg" alt=""></div>
                                        <div class="media-body">
                                            <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                                            <span>Mar 12 10:40pm</span>
                                        </div><!-- media-body -->
                                    </div><!-- media -->
                                </div><!-- az-notification-list -->
                                <div class="dropdown-footer"><a href="">View All Notifications</a></div>
                            </div><!-- dropdown-menu -->
                        </div><!-- az-header-notification -->
                        <div class="dropdown az-profile-menu">
                            <a href="" class="az-img-user"><img class="align-self-start mr-3" src="<?= Yii::$app->member->profilePicture; ?>" alt="user avatar"></a>
                            <div class="dropdown-menu">
                                <div class="az-dropdown-header d-sm-none">
                                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                                </div>
                             
                                <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                                <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a> 
                                <a href="<?= Url::to(['site/logout']); ?>" class="dropdown-item"><i class="typcn typcn-power-outline"></i>
                                    Sign Out</a>
                            </div><!-- dropdown-menu -->
                        </div>
                    </div><!-- az-header-right -->
                </div><!-- container -->
            </div><!-- az-header -->
            <div class="az-navbar az-navbar-two az-navbar-dashboard-eight">
  
</div>

            <div class="az-content-header d-block d-md-flex">
                <div>
                    <h2 class="az-content-title mg-b-5 mg-b-lg-8"><?= $this->title; ?></h2>
                    <p class="mg-b-0"><?= $this->params['page_description']; ?></p>
                </div>
            </div><!-- az-content-header -->
            <div class="az-content-body">
                <?= $content; ?>
            </div><!-- az-content-body -->

            <div class="az-footer ht-40">
                <div class="container-fluid pd-t-0-f ht-100p">
                    <span>&copy; 2021 Kumusoft Solutions</span>
                </div><!-- container -->
            </div><!-- az-footer -->
        </div><!-- az-content -->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
