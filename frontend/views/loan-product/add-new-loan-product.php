<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanProduct */

$this->title = 'New Loan Product';
$this->params['breadcrumbs'][] = ['label' => 'Loan Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Page descrition
$this->params['page_description'] = '';
?>
<div class="loan-product-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'currency' => $currency,
    ])
    ?>

</div>
