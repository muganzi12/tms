<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Member */

$this->title = 'New Next of Kin';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
//Pass CLientID to the layout 
$this->params['client_id'] = $clientId;
?>
<h5>
    Enter Details to Create New Next of Kin
</h5>
<style>
    .profile-section{}
    .profile-section h5{
        border-bottom: 3px solid #3C8BE5;
        color:#135095;
        font-weight: bold !important;
    }
</style>
<section class="sheet padding-10mm" style="padding:0 7px 0 7px;">

      <div class="profile-section" style="margin-top:20px;">

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
