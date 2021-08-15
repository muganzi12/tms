<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Client */

$this->title = 'Update: ' . $model->name . ' '.'Details';
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['page_description'] = '';
?>
<?= $this->render('registration/reg-steps-top-nav',['model'=>$model,'active'=>'inst',]); ?>


<div class="az-dashboard-nav"> 
    <nav class="nav">
    
    </nav>
</div>
<div class="client-form">
    <div class="col-lg-9">

    <?= $this->render('_update-form', [
        'model' => $model,
    ]) ?>

</div>

  <div class="col-lg-3">
        <?= Html::a('Update Company details', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']) ?>
        <?= Html::a('New company admin', ['user/new-admin', 'id' => $model->id], ['class' => 'btn btn-info btn-block']) ?>
        <?= Html::a('Upload Logo', ['update', 'id' => $model->id], ['class' => 'btn btn-secondary btn-block']) ?>
   
    </div>
