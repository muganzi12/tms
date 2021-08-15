<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Branch */

$this->title = 'New Branch';
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Page descrition
$this->params['page_description'] = '';
?>
<div class="branch-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
