<?php

/* @var $this yii\web\View */
/* @var $model common\models\property\Property */

$this->title = 'Update Property: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="property-update">

    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
