<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use common\models\sacco\Branch;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>

            <td>
                <?= $form->field($model, 'firstname')->textInput() ?>  
            </td>
            <td><?= $form->field($model, 'lastname')->textInput() ?>
            <td>
                <?= $form->field($model, 'username')->textInput() ?>  
            </td>

        </tr>

        <tr>
        <td>
              <?= $form->field($model, 'othername')->textInput() ?>  
            </td>
            <td>
                <?= $form->field($model, 'telephone')->textInput() ?>  
            </td>
            <td><?= $form->field($model, 'email')->textInput() ?></td>
           
        

        </tr>
        
        <tr>
            
                
               <td><?= $form->field($model, 'office_id')->textInput() ?></td>
        
                 <td>
                <?php
                echo $form->field($model, 'branch_id')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map(Branch::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Branch',
                        'class' => 'form-control',
                        //'id' => 'user-outlet-id',
                        'multiple' => false
                    ]
                ]);
                ?>
            </td>
        
        </tr>

        <tr>

            <td>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'created_by')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'account_type')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'sacco_id')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'app_module')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'password_hash')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'password_status')->hiddenInput()->label(false); ?>
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
