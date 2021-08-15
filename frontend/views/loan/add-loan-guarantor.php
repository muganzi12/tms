<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'Add Loan Gurantor';
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('registration/reg-steps-top-nav', ['model' => $loan, 'active' => 'guarantor']); ?>

<div class="row">

    <div class="col-lg-10" style="padding:0px;">


        <?=
        $this->render('_loan-guarantor-form', [
            'model' => $model,
            'loan' => $loan,
            'ident' => $ident,
            'sex' => $sex,
        ])
        ?>

    </div>
    <div class="col-lg-2" style="padding:12px;">
        <?= $this->render('registration/left-navigation', ['model' => $loan, 'active' => 'summary']); ?>            
    </div>
</div>
