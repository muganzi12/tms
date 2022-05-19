<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\revenue\IndividualOwner */

$this->title = $model->firstname.' '.$model->lastname;
$this->params['hide_page_title'] = true;
//Pass CLientID to the layout 
$this->params['client_id'] = $clientId;
?>
<style>
    .profile-section{}
    .profile-section h5{
        border-bottom: 3px solid #3C8BE5;
        color:#135095;
        font-weight: bold !important;
    }
    body {
    background-color: #eee
}

.mt-70 {
    margin-top: 70px
}

.mb-70 {
    margin-bottom: 70px
}

.card {
    box-shadow: 0 0.46875rem 2.1875rem rgba(4, 9, 20, 0.03), 0 0.9375rem 1.40625rem rgba(4, 9, 20, 0.03), 0 0.25rem 0.53125rem rgba(4, 9, 20, 0.05), 0 0.125rem 0.1875rem rgba(4, 9, 20, 0.03);
    border-width: 0;
    transition: all .2s
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(26, 54, 126, 0.125);
    border-radius: .25rem
}

.card-body {
    flex: 1 1 auto;
    padding: 1.25rem
}

.vertical-timeline {
    width: 100%;
    position: relative;
    padding: 1.5rem 0 1rem
}

.vertical-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 67px;
    height: 100%;
    width: 4px;
    background: #e9ecef;
    border-radius: .25rem
}

.vertical-timeline-element {
    position: relative;
    margin: 0 0 1rem
}

.vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
    visibility: visible;
    animation: cd-bounce-1 .8s
}

.vertical-timeline-element-icon {
    position: absolute;
    top: 0;
    left: 60px
}

.vertical-timeline-element-icon .badge-dot-xl {
    box-shadow: 0 0 0 5px #fff
}

.badge-dot-xl {
    width: 18px;
    height: 18px;
    position: relative
}

.badge:empty {
    display: none
}

.badge-dot-xl::before {
    content: '';
    width: 10px;
    height: 10px;
    border-radius: .25rem;
    position: absolute;
    left: 50%;
    top: 50%;
    margin: -5px 0 0 -5px;
    background: #fff
}

.vertical-timeline-element-content {
    position: relative;
    margin-left: 90px;
    font-size: .8rem
}

.vertical-timeline-element-content .timeline-title {
    font-size: .8rem;
    text-transform: uppercase;
    margin: 0 0 .5rem;
    padding: 2px 0 0;
    font-weight: bold
}

.vertical-timeline-element-content .vertical-timeline-element-date {
    display: block;
    position: absolute;
    left: -90px;
    top: 0;
    padding-right: 10px;
    text-align: right;
    color: #adb5bd;
    font-size: .7619rem;
    white-space: nowrap
}

.vertical-timeline-element-content:after {
    content: "";
    display: table;
    clear: both
}
</style>
  <div class="card-body">
                <h5 class="card-title">Activity Logs</h5>
                <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                      <?php
                foreach ($model->clientRemarks AS $tp) {
                    ?>
                
                    <div class="vertical-timeline-item vertical-timeline-element">
                        <div> <span class="avatar avatar-sm">   <img src="<?= $tp->createdBy->profilePicture; ?>" alt="avatar" class="avatar-img rounded-circle">
                            </span>
                            <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">ACTIVITY DONE ON A <?= $tp['category']; ?></h4>
                                
                                <p><?= $tp['remarks']; ?> <a href="javascript:void(0);" data-abc="true"><?= Yii::$app->formatter->asTime($tp['created_at']); ?></a></p> <span class="vertical-timeline-element-date"> <?= Yii::$app->formatter->asDate($tp['created_at']); ?></span>
                                 <i> <span class=""> By <?= $tp->createdBy->fullnames; ?></span></i>
                                
                             
                            </div>
                        </div>
                    </div>
                        <?php } ?>
             
                </div>
            </div> 
