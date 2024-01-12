<?php

use yii\helpers\Url;
?>
<div id="header"
     class="mdk-header js-mdk-header m-0"
     data-fixed>
    <div class="mdk-header__content">

        <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-dark"
             id="navbar"
             data-primary>
            <div class="container-fluid p-0">

                <!-- Navbar toggler -->

                <button class="navbar-toggler navbar-toggler-right d-block d-lg-none"
                        type="button"
                        data-toggle="sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a>
            <img src="<?=Yii::getAlias('@web/html');?>/images/demos.png" style="height: 60px;margin-left:20px;"/>

        </a>

                <!-- Navbar Brand -->
                <a href="<?=Url::base(true);?>" class="navbar-brand ">
                         <h4> <span> Tenant Managemen</span></h4>
                </a>


                <form class="search-form d-none d-sm-flex flex"
                      action="index.html">
                    <button class="btn"
                            type="submit"><i class="material-icons">search</i></button>
                    <input type="text"
                           class="form-control"
                           placeholder="Search">
                </form>

                <ul class="nav navbar-nav ml-auto d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a href="<?=Url::to(['site/admin']);?>"
                           class="nav-link"
                           data-caret="false">
                            <i class="material-icons nav-icon">settings</i>
                        </a>
                        <a href="#notifications_menu"
                           class="nav-link dropdown-toggle"
                           data-toggle="dropdown"
                           data-caret="false">
                            <i class="material-icons nav-icon navbar-notifications-indicator">notifications</i>
                        </a>
                        <div id="notifications_menu"
                             class="dropdown-menu dropdown-menu-right navbar-notifications-menu">
                            <div class="dropdown-item d-flex align-items-center py-2">
                                <span class="flex navbar-notifications-menu__title m-0">Notifications</span>
                                <a href="javascript:void(0)"
                                   class="text-muted"><small>Clear all</small></a>
                            </div>
                            <div class="navbar-notifications-menu__content"
                                 data-perfect-scrollbar>
                                <div class="py-2">

                                    <div class="dropdown-item d-flex">
                                        <div class="mr-3">
                                            <div class="avatar avatar-sm"
                                                 style="width: 32px; height: 32px;">
                                                <img src="<?=Url::base(true);?>/flowdash/assets/images/256_daniel-gaffey-1060698-unsplash.jpg"
                                                     alt="Avatar"
                                                     class="avatar-img rounded-circle">
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <a href="">A.Demian</a> left a comment on <a href="">FlowDash</a><br>
                                            <small class="text-muted">1 minute ago</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-item d-flex">
                                        <div class="mr-3">
                                            <a href="#">
                                                <div class="avatar avatar-xs"
                                                     style="width: 32px; height: 32px;">
                                                    <span class="avatar-title bg-purple rounded-circle"><i class="material-icons icon-16pt">person_add</i></span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="flex">
                                            New user <a href="#">Peter Parker</a> signed up.<br>
                                            <small class="text-muted">1 hour ago</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-item d-flex">
                                        <div class="mr-3">
                                            <a href="#">
                                                <div class="avatar avatar-xs"
                                                     style="width: 32px; height: 32px;">
                                                    <span class="avatar-title rounded-circle">JD</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <a href="#">Big Joe</a> <small class="text-muted">wrote:</small><br>
                                            <div>Hey, how are you? What about our next meeting</div>
                                            <small class="text-muted">2 minutes ago</small>
                                        </div>
                                    </div>

                                    <div class="dropdown-item d-flex">
                                        <div class="mr-3">
                                            <div class="avatar avatar-sm"
                                                 style="width: 32px; height: 32px;">
                                                <img src="<?=Url::base(true);?>/flowdash/assets/images/256_daniel-gaffey-1060698-unsplash.jpg"
                                                     alt="Avatar"
                                                     class="avatar-img rounded-circle">
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <a href="">A.Demian</a> left a comment on <a href="">FlowDash</a><br>
                                            <small class="text-muted">1 minute ago</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-item d-flex">
                                        <div class="mr-3">
                                            <a href="#">
                                                <div class="avatar avatar-xs"
                                                     style="width: 32px; height: 32px;">
                                                    <span class="avatar-title bg-purple rounded-circle"><i class="material-icons icon-16pt">person_add</i></span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="flex">
                                            New user <a href="#">Peter Parker</a> signed up.<br>
                                            <small class="text-muted">1 hour ago</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-item d-flex">
                                        <div class="mr-3">
                                            <a href="#">
                                                <div class="avatar avatar-xs"
                                                     style="width: 32px; height: 32px;">
                                                    <span class="avatar-title rounded-circle">JD</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <a href="#">Big Joe</a> <small class="text-muted">wrote:</small><br>
                                            <div>Hey, how are you? What about our next meeting</div>
                                            <small class="text-muted">2 minutes ago</small>
                                        </div>
                                    </div>

                                    <div class="dropdown-item d-flex">
                                        <div class="mr-3">
                                            <div class="avatar avatar-sm"
                                                 style="width: 32px; height: 32px;">
                                                <img src="<?=Url::base(true);?>/flowdash/assets/images/256_daniel-gaffey-1060698-unsplash.jpg"
                                                     alt="Avatar"
                                                     class="avatar-img rounded-circle">
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <a href="">A.Demian</a> left a comment on <a href="">FlowDash</a><br>
                                            <small class="text-muted">1 minute ago</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-item d-flex">
                                        <div class="mr-3">
                                            <a href="#">
                                                <div class="avatar avatar-xs"
                                                     style="width: 32px; height: 32px;">
                                                    <span class="avatar-title bg-purple rounded-circle"><i class="material-icons icon-16pt">person_add</i></span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="flex">
                                            New user <a href="#">Peter Parker</a> signed up.<br>
                                            <small class="text-muted">1 hour ago</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-item d-flex">
                                        <div class="mr-3">
                                            <a href="#">
                                                <div class="avatar avatar-xs"
                                                     style="width: 32px; height: 32px;">
                                                    <span class="avatar-title rounded-circle">JD</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="flex">
                                            <a href="#">Big Joe</a> <small class="text-muted">wrote:</small><br>
                                            <div>Hey, how are you? What about our next meeting</div>
                                            <small class="text-muted">2 minutes ago</small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <a href="javascript:void(0);"
                               class="dropdown-item text-center navbar-notifications-menu__footer">View All</a>
                        </div>
                    </li>
                </ul>

                <ul class="nav navbar-nav d-none d-sm-flex border-left navbar-height align-items-center">
                    <li class="nav-item dropdown">
                        <a href="#account_menu"
                           class="nav-link dropdown-toggle"
                           data-toggle="dropdown"
                           data-caret="false">
                            <span class="mr-1 d-flex-inline">
                                <span class="text-light"><?=Yii::$app->member->firstname;?> <?=Yii::$app->member->lastname;?></span>
                            </span><br>
                                <span class="mr-1 d-flex-inline">
                                <span class="text-light"><?=Yii::$app->member->officeHeld;?></span>
                            </span>
                            <img src="<?=Yii::$app->member->profilePicture;?>"
                                 class="rounded-circle"
                                 width="32"
                                 alt="Frontted">
                        </a>
                        <div id="account_menu"
                             class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item-text dropdown-item-text--lh">
                                <div><strong><?=Yii::$app->member->fullnames;?></strong></div>
                                <div class="text-muted"><?=Yii::$app->member->username;?></div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="<?=Url::home();?>"><i class="material-icons">dvr</i> Dashboard</a>
                            <a class="dropdown-item"
                               href="<?=Url::to(['profile/index', 'id' => Yii::$app->member->id]);?>"><i class="material-icons">account_circle</i> My profile</a>
                            <a class="dropdown-item"
                               href="<?=Url::to(['user/update', 'id' => Yii::$app->member->id]);?>"><i class="material-icons">edit</i> Edit account</a>
                                <a class="dropdown-item"
                               href="<?=Url::to(['site/change-mypasswd', 'id' => Yii::$app->member->id]);?>"><i class="material-icons">lock</i> Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="<?=Url::to(['site/logout']);?>"><i class="material-icons">exit_to_app</i> Logout</a>
                        </div>
                    </li>
                </ul>

            </div>
        </div>

    </div>
</div>

