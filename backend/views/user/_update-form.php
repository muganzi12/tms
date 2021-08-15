<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Institution;
use yii\helpers\Url;
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>

            <td>
                <?= $form->field($model, 'firstname')->textInput() ?>  
            </td>
            <td><?= $form->field($model, 'lastname')->textInput() ?>
            </td>
            <td>
                <?= $form->field($model, 'username')->textInput() ?>  
            </td>

        </tr>
        <tr>
            <td><?= $form->field($model, 'email')->textInput() ?></td>
            <td><?= $form->field($model, 'telephone')->textInput() ?></td>
         
            <td><?= $form->field($model, 'app_module')->dropDownList(ArrayHelper::map($modules, 'id', 'name'), ['prompt' => 'Select System Module']) ?></td>

        </tr>



        <tr>

            <td>
                 <?= $form->field($model, 'created_at')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'created_by')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'account_type')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'sacco_id')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'office_id')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'password_hash')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'password_status')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'branch_id')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'auth_key')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'status')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false); ?> 
            </td>
        </tr>

        <tr>
            <td>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </td>
            <td colspan="3"></td>
        </tr>
    </table>


    <div class="form-group">

    </div>

    <?php ActiveForm::end(); ?>

</div>
