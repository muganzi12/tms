<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/*
 * Reset password for logged-in Users
 */
$this->title = "Change password";
//Pass CLientID to the layout 
$this->params['user_id'] = $userId;
?>
<div class="row">

    <div class="col-lg-9 content-box" style="padding-top:3px;">
        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

  
        <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password_compare')->passwordInput()->label('Confirm Password') ?>
        <?= $form->field($model, 'password_status')->hiddenInput(['value' =>1])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-block']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
