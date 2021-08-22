<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'New  Loan Application';
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
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
    <?= $this->render('details/page-header', ['model' => $client, 'active_menu' => 'loan']); ?>
      <?= $this->render('../client/registration/reg-steps-top-nav',['model'=>$client,'active'=>'loan']); ?>
      <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-10" style="padding:0px;">

        <?=
        $this->render('_form', [
            'model' => $model,
            'client' => $client,
            'currency' => $currency,
        ])
        ?>

    </div>
    <div class="col-lg-2" style="padding:12px;">
        <?= $this->render('../client/registration/left-navigation', ['model' => $client, 'active' => 'summary']); ?>            
    </div>
</div>
