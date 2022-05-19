<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*
 * upload profile picture for the logged in person
 */
$this->title = "Upload profile picture";
//Pass CLientID to the layout 
$this->params['user_id'] = $userId;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<div class="row">

    <div class="col-lg-9 content-box" style="padding-top:3px;">
        <div class="element-wrapper">
            
                <div class="row">
                    <div class="tab-content">
                        <div class="col-lg-8">
                            <?= $form->field($model, 'profile_pic')->fileInput()->label('Browse profile picture') ?> 
                        </div>
                        <div class="col-lg-4" style="margin-top:20px;">
                            <?= Html::submitButton('Upload Profile picture', ['class' => 'btn btn-success']) ?> 
                        </div>
                        <div class="col-lg-12">
                            <?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
                            <?= $form->field($model, 'username')->hiddenInput()->label(false); ?>
                            <?= $form->field($model, 'firstname')->hiddenInput()->label(false); ?>
                            <?= $form->field($model, 'lastname')->hiddenInput()->label(false); ?>
                            <?= $form->field($model, 'status')->hiddenInput()->label(false); ?>
                            <?= $form->field($model, 'email')->hiddenInput()->label(false); ?>
                           
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
        
        </div>
    </div>
</div>