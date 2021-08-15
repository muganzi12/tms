<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\member\Member */

$this->title = 'Update Details  : ' . $model->firstname. ' '. $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['page_description'] = '';
?>
<?= $this->render('registration/reg-steps-top-nav',['model'=>$model,'active'=>'member']); ?>
<div class="member-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
