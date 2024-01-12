<?php

/* @var $this yii\web\View */
/* @var $model common\models\location\Street */

$this->title = 'Update Street: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Streets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="street-update">



    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
