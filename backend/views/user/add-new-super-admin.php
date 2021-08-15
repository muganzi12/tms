<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'New Admin';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
?>

<div class="client-form">
 
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
