<?php

/* @var $this yii\web\View */
/* @var $model common\models\property\PropertyUnit */

$this->title = 'Update Property Unit: ' . $model->unit_number;
$this->params['breadcrumbs'][] = ['label' => 'Property Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->unit_number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="property-unit-update">


    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
