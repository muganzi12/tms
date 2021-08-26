<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*
 * upload profile picture for the logged in person
 */
$this->title = "Upload profile picture";
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<div class="row">

    <div class="col-lg-9 content-box" style="padding-top:3px;">
        <div class="element-wrapper">

            <div class="row">
                <div class="tab-content">
                    <div class="col-lg-8">
                        <?= $form->field($model, 'passport_photo')->fileInput(['required'=>true])->label('Browse Passport Photo') ?> 
                    </div>
                    <div class="col-lg-4" style="margin-top:20px;">
                        <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?> 
                    </div>
                    <div class="col-lg-12">
                        <?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'reference_number')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'firstname')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'lastname')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'othername')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'identification_type')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'identification_number')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'telephone')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'alt_telephone')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'gender')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'email')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'marital_status')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'date_of_birth')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'address')->hiddenInput()->label(false); ?>

                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>