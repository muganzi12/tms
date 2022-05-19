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
</style>
<section class="sheet padding-10mm" style="padding:0 7px 0 7px;">
    <div class="profile-section" style="margin-top:0px;">
        <h5>Client Details
            <?php //= Html::a('<i class="os-icon os-icon-download"></i> Download Profile',['company/download-profile','id'=>$model->id],['class'=>'btn btn-dark pull-right'])  ?>
        </h5>
      <?= $this->render('details/client-details', ['model' => $model]); ?>
    </div>
    <div class="profile-section">
        <h5>Next of Kin Details</h5>
                <?= $this->render('details/kin-details', ['model' => $model]); ?>
    </div>
    
        <div class="profile-section">
        <h5>Identification Documents</h5>
                <?= $this->render('details/supporting-documents', ['model' => $model]); ?>
    </div>
 
</section>