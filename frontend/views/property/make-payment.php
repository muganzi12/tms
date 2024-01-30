<?php

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanManagerRemarks */

$this->title = 'Register Payment';
$this->params['breadcrumbs'][] = ['label' => 'Make Payment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Pass CLientID to the layout
$this->params['property_id'] = $propertyId;
?>

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
$this->render('_payment-form', [
    'model' => $model,
    'property' => $property,
])
?>


    </div>

</div>
