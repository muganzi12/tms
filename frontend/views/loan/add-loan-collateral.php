<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'Add Loan Collateral';
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('registration/reg-steps-top-nav', ['model' => $loan, 'active' => 'collateral']); ?>

<div class="row">

    <div class="col-lg-10" style="padding:0px;">


        <?=
        $this->render('_loan-collateral-form', [
            'model' => $model,
            'loan' => $loan,
            'type' => $type,
        ])
        ?>

    </div>
    <div class="col-lg-2" style="padding:12px;">
        <?= $this->render('registration/left-navigation', ['model' => $loan, 'active' => 'summary']); ?>            
    </div>
</div>
