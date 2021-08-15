<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'New Admin';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
?>

<?= $this->render('../company/registration/reg-steps-top-nav',['model'=>$inst,'active'=>'inst',]); ?>
<div class="az-dashboard-nav"> 
    <nav class="nav">
    
    </nav>
</div>
<div class="client-form">
    <div class="col-lg-9">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


  <div class="col-lg-3">
        <?= Html::a('Update Company details', ['company/update', 'id' => $inst->id], ['class' => 'btn btn-primary btn-block']) ?>
        <?= Html::a('New Company admin', ['user/new-admin', 'id' => $inst->id], ['class' => 'btn btn-info btn-block']) ?>
        <?= Html::a('Upload Logo', ['update', 'id' => $inst->id], ['class' => 'btn btn-secondary btn-block']) ?>
      
    </div>