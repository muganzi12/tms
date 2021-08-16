<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Institution */

$this->title = 'Update  ' . $model->firstname .' '.$model->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Institutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?> 
<?= $this->render('registration/reg-steps-top-nav',['model'=>$model,'active'=>'logo',]); ?>
<div class="institution-update">
    <?= $this->render('_photo-form', [
        'model' => $model,
    ]) ?>

</div>
