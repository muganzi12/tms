<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Institution */

$this->title = 'Update  ' . $model->firstname .' '.$model->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Institutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
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

      <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-10" style="padding:0px;">



    <?= $this->render('_photo-form', [
        'model' => $model,
    ]) ?>

</div>

</div>