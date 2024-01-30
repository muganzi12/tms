<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin();?>
    <table class="table">
    <div class="row">

    <div class="col-sm-6">
                <?=$form->field($model, 'payment_date')->textInput(['required' => true])?>

</div>

<div class="col-sm-6">
            <?=$form->field($model, 'amount')->textInput(['required' => true])?>
</div>
</div>


<div class="row">

<div class="col-sm-6">
            <?=$form->field($model, 'payment_channel')->textInput(['required' => true])?>
</div>
<div class="col-sm-6">
            <?=$form->field($model, 'payment_mode')->textInput(['required' => true])?>
</div>
</div>



<div class="row">

<div class="col-sm-6">
            <?=$form->field($model, 'mobile_number')->textInput(['required' => true])?>
</div>
<div class="col-sm-6">
            <?=$form->field($model, 'mobile_number')->textInput(['required' => true])?>
</div>
</div>


<div class="row">

<div class="col-sm-6">
                <?=Html::submitButton(($model->id > 0) ? ('Update') : ('Make Payment'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-success'), 'style' => 'margin-top:30px;'])?>
</div>
<div class="col-sm-6">

                <?=$form->field($model, 'created_by')->hiddenInput()->label(false)?>
                <?=$form->field($model, 'created_at')->hiddenInput()->label(false)?>
                <?=$form->field($model, 'updated_at')->hiddenInput()->label(false)?>
                <?=$form->field($model, 'updated_by')->hiddenInput()->label(false)?>
                <?=$form->field($model, 'status')->hiddenInput()->label(false)?>
                <?=$form->field($model, 'property_id')->hiddenInput()->label(false)?>
                <?=$form->field($model, 'id')->hiddenInput()->label(false)?>


</div>
</div>
    </table>
    <?php ActiveForm::end();?>

</div>
