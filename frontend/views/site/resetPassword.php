<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/*
 * Reset password for logged-in Users
 */
$this->title = "Change password";
?>


<div class="site-login">
      <p>Please choose your new password:</p>
    <div class="row">
        <div class="col-lg-12">
             <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?> 
               <h8>Your are required to change your default password</h8><br>
               
          <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label('New Password') ?>
         <?= $form->field($model, 'password_compare')->passwordInput()->label('Confirm Password') ?>
         <?= $form->field($model, 'password_status')->hiddenInput(['value' =>1])->label(false) ?>
      
            <div class="form-group">
               <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-block']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>