<?php

/* @var $this yii\web\View */
/* @var $model common\models\location\District */

$this->title = 'Register New District';
$this->params['breadcrumbs'][] = ['label' => 'Districts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-create">

    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
