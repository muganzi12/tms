<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\revenue\IndividualOwner */

$this->title = $model->firstname.' '.$model->lastname;
$this->params['hide_page_title'] = true;
?>
<style>
    .profile-section{}
    .profile-section h5{
        border-bottom: 3px solid #3C8BE5;
        color:#135095;
        font-weight: bold !important;
    }
</style>
<section class="sheet padding-10mm" style="padding:0 7px 0 7px;">
    <table class="table" style="margin:0px;">
        <tr>
       
            <td width="80%" class="text-center">
                <h2><?= $model->firstname.' '.$model->lastname; ?></h2>
                <h5><i class="os-icon os-icon-map-pin"></i> <?= $model->address; ?> | <i class="os-icon os-icon-phone-15"></i> <?= $model->telephone; ?> | <i class="os-icon os-icon-email-2-at"></i> <?= $model->email; ?></h5>
                <p style="color:#036;font-size:135%;font-weight:bold;">File number: <?= $model->reference_number; ?></p>
            </td>
         
        </tr>
    </table>
    <div class="os-tabs-w">
        <div class="os-tabs-controls os-tabs-complex" style="margin-bottom: 10px;">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link  active" href="#">
                        <span class="tab-label"><i class="os-icon os-icon-newspaper"></i> Profile</span>  
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <span class="tab-label"><i class="os-icon os-icon-briefcase"></i> Assessments</span>  
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <span class="tab-label"><i class="os-icon os-icon-briefcase"></i> Payments</span>  
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <span class="tab-label"><i class="os-icon os-icon-briefcase"></i> Licenses</span>  
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <span class="tab-label"><i class="os-icon os-icon-briefcase"></i> Guns</span>  
                    </a>
                </li>
                <?php if ($model->status == 1) { ?>
                    <li class="nav-item nav-actions">
                        <a class="nav-link " href="<?= Url::to(['client/update', 'id' => $model->id]); ?>">
                            <span class="tab-label"><i class="os-icon os-icon-pencil-2"></i> Update Details</span>  
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="profile-section" style="margin-top:20px;">
        <h5>Client Details
            <?php //= Html::a('<i class="os-icon os-icon-download"></i> Download Profile',['company/download-profile','id'=>$model->id],['class'=>'btn btn-dark pull-right'])  ?>
        </h5>
      <?= $this->render('details/client-details', ['model' => $model]); ?>
    </div>
    <div class="profile-section">
        <h5>Next of Kin Details</h5>
                <?= $this->render('details/kin-details', ['model' => $model]); ?>
    </div>
 
</section>