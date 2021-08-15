<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanManagerRemarks */

$this->title = 'Enter  Remarks to Reject a Client';
$this->params['breadcrumbs'][] = ['label' => 'Loan Manager Remarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('registration/reg-steps-top-nav', ['model' => $client, 'active' => 'rejection']); ?>

<div class="row">

    <div class="col-lg-10" style="padding:0px;">


        <?=
        $this->render('_approval-form', [
            'model' => $model,
            'client' => $client,
        ])
        ?>


    </div>
    <div class="col-lg-2" style="padding:12px;">
<?= $this->render('registration/left-navigation', ['model' => $client, 'active' => 'summary']); ?>            
    </div>
</div>
