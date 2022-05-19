<?php

use yii\helpers\Html;
use common\models\loan\RatedItem;
/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'New  Loan Application';
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Pass CLientID to the layout 
$this->params['client_id'] = $clientId;
   $schedule = RatedItem::find()->all();
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

        <div class="col-lg-12" style="padding:0px;">


            <?=
            $this->render('_form', [
                'model' => $model,
                'client' => $client,
                'type' => $type,
            ])
            ?>

        </div>

    </div>
    
    <pre>
        <?php   print_r($schedule);?>
    </pre>
