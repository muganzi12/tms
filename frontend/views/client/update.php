<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Member */

$this->title = 'Update Member: ' . $model->firstname .' ' .$model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['page_description'] = '';
?>
<?= $this->render('registration/reg-steps-top-nav',['model'=>$model,'active'=>'update']); ?>
<div class="row">  
    <div class="col-lg-10" style="padding:0px;">
    <?=
    $this->render('_form', [
        'model' => $model,
        'ident' => $ident,
        'sex' => $sex,
        'marital' => $marital,
     
    ])
    ?>

</div>
   <div class="col-lg-2" style="padding:0px;">
        <?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
    </div>
</div>