<?php

/* @var $this yii\web\View */
/* @var $model common\models\location\Parish */

$this->title = 'Register New Parish';
$this->params['breadcrumbs'][] = ['label' => 'Parishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parish-create">


    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
