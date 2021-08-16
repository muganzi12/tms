<?php

use yii\helpers\Url;

/*
 * Links to display on top of the registration forms
 */
?>
<style>
    .sw-main {
        position: relative;
        display: block;
        margin: 0;
        padding: 0;
        border-radius: .25rem!important;
    }

    .sw-main .sw-container {
        display: block;
        margin: 0;
        padding: 0;
        position: relative;
    }

    .sw-main .step-content {
        display: none;
        position: relative;
        margin: 0;
    }

    .sw-main .sw-toolbar {
        margin-left: 0;
    }

    /* SmartWizard Theme: White */
    .sw-theme-default {
        -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
    }

    .sw-theme-default .sw-container {
        min-height: 250px;
    }

    .sw-theme-default .step-content {
        padding: 10px;
        border: 0px solid #D4D4D4;
        background-color: #FFF;
        text-align: left;
    }

    .sw-theme-default .sw-toolbar {
        background: #f9f9f9;
        border-radius: 0 !important;
        padding-left: 10px;
        padding-right: 10px;
        padding: 10px;
        margin-bottom: 0 !important;
    }

    .sw-theme-default .sw-toolbar-top {
        border-bottom-color: #ddd !important;
    }

    .sw-theme-default .sw-toolbar-bottom {
        border-top-color: #ddd !important;
    }

    .sw-theme-default > ul.step-anchor > li {
        position: relative;
        margin-right: 2px;
    }

    .sw-theme-default > ul.step-anchor > li > a, .sw-theme-default > ul.step-anchor > li > a:hover {
        border: none !important;
        color: #bbb;
        text-decoration: none;
        outline-style: none;
        background: transparent !important;
        border: none !important;
        cursor: not-allowed;
    }

    .sw-theme-default > ul.step-anchor > li.clickable > a:hover {
        color: #4285F4 !important;
        background: transparent !important;
        cursor: pointer;
    }

    .sw-theme-default > ul.step-anchor > li > a::after {
        content: "";
        background: #4285F4;
        height: 2px;
        position: absolute;
        width: 100%;
        left: 0px;
        bottom: 0px;
        -webkit-transition: all 250ms ease 0s;
        transition: all 250ms ease 0s;
        -webkit-transform: scale(0);
        -ms-transform: scale(0);
        transform: scale(0);
    }

    .sw-theme-default > ul.step-anchor > li.active > a {
        border: none !important;
        color: #4285F4 !important;
        background: transparent !important;
        cursor: pointer;
    }

    .sw-theme-default > ul.step-anchor > li.active > a::after {
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }

    .sw-theme-default > ul.step-anchor > li.done > a {
        border: none !important;
        color: #000 !important;
        background: transparent !important;
        cursor: pointer;
    }

    .sw-theme-default > ul.step-anchor > li.done > a::after {
        background: #5cb85c;
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }

    .sw-theme-default > ul.step-anchor > li.danger > a {
        border: none !important;
        color: #d9534f !important;
        /* background: #d9534f !important; */
        cursor: pointer;
    }

    .sw-theme-default > ul.step-anchor > li.danger > a::after {
        background: #d9534f;
        border-left-color: #f8d7da;
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }

    .sw-theme-default > ul.step-anchor > li.disabled > a, .sw-theme-default > ul.step-anchor > li.disabled > a:hover {
        color: #eee !important;
        cursor: not-allowed;
    }

    .sw-theme-default ul li.completed a{
        color: green !important;
        fonr-weight:bold;
        cursor: pointer;
    }

    /* Responsive CSS */
    @media screen and (max-width: 768px) {
        .sw-theme-default > .nav-tabs > li {
            float: none !important;
        }
    }
</style>
<div id="smartwizard" class="sw-main sw-theme-default">
    <ul class="nav nav-tabs nav-tabs-justified step-anchor"> <ul class="nav nav-tabs">    
            <li class="nav-item <?= ($active == 'member') ? ('active') : (''); ?>"><a href="<?= Url::to(['client/view', 'id' => $model->id]); ?>" class="nav-link">Client Profile</a></li>
        <li class="nav-item <?= ($active == 'kin') ? ('active') : (''); ?>"><a href="<?= Url::to(['client/next-of-kin', 'id' => $model->id]); ?>" class="nav-link">Next of Kin Details</a></li>
        <li class="nav-item <?= ($active == 'upload') ? ('active') : (''); ?>"><a href="<?= Url::to(['client/uploaded-documents', 'id' => $model->id]); ?>" class="nav-link"> Documents</a></li>
        <li class="nav-item <?= ($active == 'loan') ? ('active') : (''); ?>"><a href="<?= Url::to(['loan/loan-applications', 'id' => $model->id]); ?>" class="nav-link">Loan Applications</a></li>
         <?php if ($model->status == 20) { ?>
        <li class="nav-item <?= ($active == 'update') ? ('active') : (''); ?>"><a href="<?= Url::to(['client/update', 'id' => $model->id]); ?>" class="nav-link">Update Details</a></li>
 <?php } ?>
    </ul>

</div>


