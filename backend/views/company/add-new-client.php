<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Client */

$this->title = 'New Comoany';
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Page descrition
$this->params['page_description'] = 'Cleint';
?>
<div class="client-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
