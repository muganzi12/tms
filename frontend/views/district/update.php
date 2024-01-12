<?php

/* @var $this yii\web\View */
/* @var $model common\models\location\District */

$this->title = 'Update District: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Districts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="district-update">

    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
