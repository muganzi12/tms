<?php

/* @var $this yii\web\View */
/* @var $model common\models\location\Division */

$this->title = 'Register New Division';
$this->params['breadcrumbs'][] = ['label' => 'Divisions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="division-create">

    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
