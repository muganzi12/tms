<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Investor */

$this->title = 'Record New Investment';
$this->params['breadcrumbs'][] = ['label' => 'Investors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Pass InvestmentID to the layout 
$this->params['investor_id'] = $investorId;
?>
<div class="investor-create">

    <?=
    $this->render('_investment-form', [
        'model' => $model,
    ])
    ?>

</div>
