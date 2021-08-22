<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanManagerRemarks */

$this->title = 'Enter  Remarks to Approve Client';
$this->params['breadcrumbs'][] = ['label' => 'Loan Manager Remarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
    <?= $this->render('details/page-header_kin', ['model' => $model, 'active_menu' => 'member']); ?>
      <?= $this->render('registration/reg-steps-top-nav',['model'=>$client,'active'=>'member']); ?>
      <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-10" style="padding:0px;">

    <?= $this->render('_approval-form', [
        'model' => $model,
        'client' => $client,
    ]) ?>

    </div>
    <div class="col-lg-2" style="padding:12px;">
<?= $this->render('registration/left-navigation', ['model' => $client, 'active' => 'summary']); ?>            
    </div>
</div>