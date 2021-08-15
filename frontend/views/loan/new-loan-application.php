<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'New  Loan Application';
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('../client/registration/reg-steps-top-nav', ['model' => $client, 'active' => 'loan']); ?>

<div class="row">

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
