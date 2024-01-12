<?php

/* @var $this yii\web\View */
/* @var $model common\models\property\Property */

$this->title = 'Register New Property';
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-create">


    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
