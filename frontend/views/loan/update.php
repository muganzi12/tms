<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'Update Loan: ' . $model->reference_number;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
    <?= $this->render('details/page-header_loan', ['model' => $model, 'active_menu' => 'loan']); ?>
      <?= $this->render('registration/reg-steps-top-nav',['model'=>$model,'active'=>'loan']); ?>
      <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-10" style="padding:0px;">



        <?=
        $this->render('_form', [
            'model' => $model,
            'currency' => $currency,
        ])
        ?>



    </div>
    <div class="col-lg-2" style="padding:12px;">
<?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
    </div>
</div>
