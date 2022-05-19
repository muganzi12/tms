<?php
use yii\helpers\Html;

$this->title = 'Update Member: ' . $model->firstname .' ' .$model->lastname;
$this->params['page_description'] = '';
//Pass LoantID to the layout 
$this->params['client_id'] = $model->id;
?>

<h2>Update profile information</h2>

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
    $this->render('_form', [
        'model' => $model,
        'ident' => $ident,
        'sex' => $sex,
        'marital' => $marital,
        'client' => $client,
        'office' => $office,
        'address' => $address,
        'classification' => $classification,
        'member' => $member,
    ])
    ?>
    </div>

    </div>