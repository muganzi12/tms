<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\sacco\Sacco */

$this->title = 'Register New Sacco';
$this->params['breadcrumbs'][] = ['label' => 'Saccos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] ='';
?>
<div class="sacco-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
