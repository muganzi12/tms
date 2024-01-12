<?php

/* @var $this yii\web\View */
/* @var $model common\models\property\PropertyUnit */

$this->title = 'Update Property Unit: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Property Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="property-unit-update">


    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
