<?php

/* @var $this yii\web\View */
/* @var $model common\models\property\MaintenanceRequest */

$this->title = ' Request Maintenance ';
$this->params['breadcrumbs'][] = ['label' => 'Maintenance Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-request-create">


    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
