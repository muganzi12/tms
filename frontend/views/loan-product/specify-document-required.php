<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanProduct */

$this->title = 'Specify Required Document';
$this->params['breadcrumbs'][] = ['label' => 'Loan Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">  
    <div class="col-lg-10" style="padding:0px;">
    <?=
    $this->render('_document-form', [
        'model' => $model,
        'client'=>$client,
    ])
    ?>

</div>

</div>
