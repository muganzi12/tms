<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Member */

$this->title = 'New Next of Kin';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
?>
<?= $this->render('registration/reg-steps-top-nav',['model'=>$client,'active'=>'kin']); ?>
<div class="row">  
    <div class="col-lg-10" style="padding:0px;"> 
<?=
    $this->render('_next-of-kin-form', [
        'model' => $model,
        'ident' => $ident,
        'sex' => $sex,
        'marital' => $marital,
        'relationship' => $relationship,
    ])
    ?>

</div>
   <div class="col-lg-2" style="padding:12px;">
        <?= $this->render('registration/left-navigation', ['model' => $client, 'active' => 'summary']); ?>            
    </div>
</div>