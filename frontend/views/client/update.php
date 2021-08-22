<?php
use yii\helpers\Html;

$this->title = 'Update Member: ' . $model->firstname .' ' .$model->lastname;
$this->params['page_description'] = '';
//Pass CLientID to the layout 
$this->params['client_id'] = $model->id;
?>
<<<<<<< HEAD
<h2>Update profile information</h2>
<div class="row">
=======
<style>
    .profile-section{}
    .profile-section h5{
        border-bottom: 3px solid #3C8BE5;
        color:#135095;
        font-weight: bold !important;
    }
</style>
<section class="sheet padding-10mm" style="padding:0 7px 0 7px;">
    <?= $this->render('details/page-header', ['model' => $model, 'active_menu' => 'update']); ?>
      <?= $this->render('registration/reg-steps-top-nav',['model'=>$model,'active'=>'update']); ?>
      <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-10" style="padding:0px;">


>>>>>>> 6d357a8e3e2a8af960131aa306b021be55185ad5
    <?=
    $this->render('_form', [
        'model' => $model,
        'ident' => $ident,
        'sex' => $sex,
        'marital' => $marital
    ])
    ?>
    </div>