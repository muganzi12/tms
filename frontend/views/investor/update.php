<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Investor */

$this->title = 'Update Investor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Investors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['investor_id'] = $investorId;
?>
<div class="investor-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'ident' => $ident,
        'ident' => $ident,
        'invest'=>$invest,
        'sex' => $sex
    ])
    ?>

</div>
