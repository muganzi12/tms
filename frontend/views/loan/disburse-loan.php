<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'Disburse Loan: ' . $model->reference_number;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('registration/reg-steps-top-nav', ['model' => $model, 'active' => 'loan']); ?>

<div class="row">

    <div class="col-lg-10" style="padding:0px;">


    <?= $this->render('_loan-disbursement-form', [
        'model' => $model,
    ]) ?>

    </div>
    <div class="col-lg-2" style="padding:12px;">
<?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
    </div>
</div>

