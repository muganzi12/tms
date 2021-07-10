<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\member\Member */

$this->title = 'Enter Details to Create a new  Member';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description']= "Members";
?>
<?= $this->render('registration/reg-steps-top-nav',['model'=>$model,'active'=>'member']); ?>
<div class="member-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
