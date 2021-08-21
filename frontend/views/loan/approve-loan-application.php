<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Loan */

$this->title = 'Approve Loan Application: ' . $model->reference_number;
?>

<?= $this->render('registration/reg-steps-top-nav', ['model' => $model, 'active' => 'loan']); ?>

<div class="row">

    <div class="col-lg-10" style="padding:0px;">


    <?= $this->render('_approval-form', [
        'model' => $model,
        'method' => $method,
    ]) ?>

    </div>
    <div class="col-lg-2" style="padding:12px;">
<?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
    </div>
</div>

