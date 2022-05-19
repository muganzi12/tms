<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Member */

$this->title = 'Update: ' . $model->firstname.' '.$model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['page_description'] = '';
$this->params['client_id'] = $clientId;
?>


<div class="row">
    
    <div class="col-lg-12" style="padding:0px;">
 
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
</div>