<?php

/* @var $this yii\web\View */
/* @var $model common\models\location\Village */

$this->title = 'Register New Village';
$this->params['breadcrumbs'][] = ['label' => 'Villages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="village-create">


    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
