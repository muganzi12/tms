<?php

/* @var $this yii\web\View */
/* @var $model common\models\property\PropertyUnits */

$this->title = 'Register New Property Unit';
$this->params['breadcrumbs'][] = ['label' => 'Property Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-units-create">


    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
