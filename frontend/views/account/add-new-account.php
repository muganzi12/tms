<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\ChartOfAccounts */

$this->title = 'Add a New Account';
$this->params['breadcrumbs'][] = ['label' => 'Chart Of Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('registration/reg-steps-top-nav', ['model' => $account, 'active' => 'header']); ?>

<div class="row">  
    <div class="col-lg-10" style="padding:0px;"> 

    <?= $this->render('_form', [
        'model' => $model,
        'type'=>$type,
        'account' => $account,
    ]) ?>

</div>
   <div class="col-lg-2" style="padding:12px;">
        <?= $this->render('registration/left-navigation', ['model' => $account, 'active' => 'summary']); ?>            
    </div>
</div>

