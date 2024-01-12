<?php

/* @var $this yii\web\View */
/* @var $model common\models\location\Street */

$this->title = 'Register New Street';
$this->params['breadcrumbs'][] = ['label' => 'Streets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="street-create">


    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
