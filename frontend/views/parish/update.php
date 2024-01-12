<?php

/* @var $this yii\web\View */
/* @var $model common\models\location\Parish */

$this->title = 'Update Parish: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Parishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parish-update">

    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
