<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masterdata\MasterData */

$this->title = 'New Master Data Record';
$this->params['breadcrumbs'][] = ['label' => 'Master Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-data-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
