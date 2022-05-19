<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\client\Member */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model);?>
    <table class="table">
        <tr>
            <td>
                <?= $form->field($model, 'firstname')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
            <td>
                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
            <td>
                <?= $form->field($model, 'othername')->textInput(['maxlength' => true]) ?>

            </td>
        </tr>

        <tr>
       
            <td colspan="2">
                <?= $form->field($model, 'nin')->textInput(['maxlength' => true]) ?>

            </td>
            <td colspan="8">
                <?= $form->field($model, 'telephone')->textInput(['maxlength' => true,'required'=>true]) ?>

            </td>
        </tr>



        <tr>
           <td colspan="2">
                    <?=
                $form->field($model, 'date_of_birth')->widget(
                        DatePicker::class,
                        [
                            'dateFormat' => 'dd-MM-yyyy',
                            'clientOptions' => [
                                'changeMonth' => false,
                                'changeYear' => true,
                                'showButtonPanel' => false,
                                'todayHighlight' => false,
                                'format' => 'Y-m-d',
                                'yearRange'=>'-110:-18',
                            ],
                             'options' => ['class' => 'form-control', 'placeholder' => '01-01-2022','required'=>true]
                ])
                ?>
            </td>
      
           <td colspan="8">
            
                 <?php
                echo $form->field($model, 'relationship')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($relationship, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'How are you related?',
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
                  <?= $form->field($model, 'address')->textArea(['maxlength' => true]) ?>
  
            </td>
        </tr>


<tr>
            <td>
                <?= Html::submitButton(($model->id > 0) ? ('Update') : ('Save'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="2">
                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'account_number')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                 <?= $form->field($model, 'related_to')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'person_scenario')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>


            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

    </div>
