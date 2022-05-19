<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
?>

    <?php $form = ActiveForm::begin(['options'=>['style'=>'width:100%;']]); ?>

<?= $form->errorSummary($model);?>
    <table class="table">
        <tr>
            <td>
                <?= $form->field($model, 'account_number')->textInput(['readonly' => true]) ?> 
            </td>
            <td>
                <?= $form->field($model, 'external_id')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
            
               <td>
                <?= $form->field($model, 'firstname')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
        
        </tr>

        <tr>
                <td>
                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
            <td>
                <?= $form->field($model, 'othername')->textInput(['maxlength' => true]) ?>
            </td>
                     <td>
                <?= $form->field($model, 'nin')->textInput(['maxlength' => true,'required'=>true]) ?>
            </td>
        
            
         
        </tr>

        <tr>
                <td>
                <?php
                echo $form->field($model, 'identification_type')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($ident, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Identification Type',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required'=>true
                    ],
                ]);
                ?>
            </td>
            <td>
                <?= $form->field($model, 'identification_number')->textInput(['maxlength' => true]) ?>
            </td>
                      <td>
                <?= $form->field($model, 'telephone')->textInput(['maxlength' => true,'required'=>true,'placeholder' => "e.g 07...."]) ?>
            </td>
     
         
          
          
        </tr>
        <tr>
               <td>
                <?= $form->field($model, 'alt_telephone')->textInput(['maxlength' => true]) ?>
            </td>
              <td>
                <?php
                echo $form->field($model, 'gender')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($sex, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Gender',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required'=>true
                    ],
                ]);
                ?>
            </td>
              <td >
                <?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder' => "example@gmail.com"]) ?>
            </td>
       
            
            
        </tr>
        
        <tr>
                 <td>
                <?php
                echo $form->field($model, 'marital_status')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($marital, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Marital Status',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required'=>true
                    ],
                ]);
                ?>
            </td>
            <td>                       
                <?=
                $form->field($model, 'date_of_birth')->widget(
                        DatePicker::class,
                        [
                            'dateFormat' => 'dd-MM-yyyy',
                            'clientOptions' => [
                                'changeMonth' => false,
                                'changeYear' => true,
                                'minDate' => '-100y',
                                'maxDate' => '0',
                                'showButtonPanel' => false,
                                'todayHighlight' => false,
                                'format' => 'Y-m-d',
                            //'yearRange' => '1990:2020'
                            ],
                            'options' => ['class' => 'form-control', 'Placeholder' => '01-02-2022', 'required' => true]
                ])
                ?>
            </td>
            
        
          
        </tr>
        <tr>
             
                     <td>
                <?php
                echo $form->field($model, 'client_type')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($client, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Client Type',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required'=>true
                    ],
                ]);
                ?>
            </td>
            
               <td>
                <?php
                echo $form->field($model, 'address_type')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($address, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Address Type',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required'=>true
                    ],
                ]);
                ?>
                </td>
            
            
                <td>
                <?php
                echo $form->field($model, 'is_staff_memeber')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($member, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Is Staff a Member?',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required'=>true
                    ],
                ]);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <?= $form->field($model, 'address')->textArea(['rows' => 2,'required'=>true]) ?>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <?= Html::submitButton(($model->id > 0) ? ('Update') : ('Save'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">
                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'client_classification_status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                  <?= $form->field($model, 'office_id')->hiddenInput()->label(false) ?>
                 <?= $form->field($model, 'next_kin_status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'person_scenario')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>
