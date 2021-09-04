<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\client\LoanAmortization;

$this->title = $model->reference_number;
$this->params['loan_id'] = $model->id;
\yii\web\YiiAsset::register($this);
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
        <h5>Loan Application Details
            <?php //= Html::a('<i class="os-icon os-icon-download"></i> Download Profile',['company/download-profile','id'=>$model->id],['class'=>'btn btn-dark pull-right'])  ?>
        </h5>
      <?= $this->render('details/loan-details', ['model' => $model]); ?>
    </div>
   
 
</section>
