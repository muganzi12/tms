<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\revenue\IndividualOwner */

$this->title = $model->firstname . ' ' . $model->lastname;
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
                <h2><?= $model->firstname . ' ' . $model->lastname; ?></h2>
                <h5><i class="os-icon os-icon-map-pin"></i> <?= $model->reference_number; ?> | <i class="os-icon os-icon-phone-15"></i> <?= $model->telephone; ?> | <i class="os-icon os-icon-email-2-at"></i> <?= $model->email; ?></h5>
                <p style="color:#036;font-size:135%;font-weight:bold;">Address: <?= $model->address; ?></p>
            </td>

        </tr>
    </table>
    <?= $this->render('registration/reg-steps-top-nav', ['model' => $model, 'active' => 'member']); ?>
    <div class="row">

        <div class="col-lg-10" style="padding:0px;">



            <div class="profile-section" style="margin-top:20px;">
                <h5>Client Details
                    
                </h5>
                <?= $this->render('details/client-details', ['model' => $model]); ?>
            </div>
            <div class="profile-section" style="margin-top:20px;">
                <h5>Next of Kin Details</h5>
                <?= $this->render('details/kin-details', ['model' => $model]); ?>
            </div>

            <div class="profile-section" style="margin-top:20px;">
                <h5>Registration Documents</h5>
                <?= $this->render('details/documents', ['dataProvider' => $model->documents]); ?>
            </div>
            <div class="profile-section">
                <h5>Approval Remarks</h5>
                <?= $this->render('details/approval-remarks', ['dataProvider' => $model->approvalRemarks]); ?>
            </div>

            <div class="profile-section">
                <h5>Rejection Remarks</h5>
                <?= $this->render('details/rejection-remarks', ['dataProvider' => $model->rejectionRemarks]); ?>
            </div>
        </div>

        <div class="col-lg-2" style="padding:10px;">
            <?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
        </div>
    </div>

</section>