<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\member\Member */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-form">

    <?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>
            <td>
           <?= $form->field($model, 'member_id_number')->textInput(['readonly' => true]) ?> 
            </td>
            <td>

                <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
            </td>
            <td>
                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $form->field($model, 'othername')->textInput(['maxlength' => true]) ?>
            </td>
            <td>
                <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>
            </td>
            <td>
                <?= $form->field($model, 'marital_status')->textInput(['maxlength' => true]) ?>
            </td>
        </tr><!-- comment -->


        <tr>
            <td>
                   <?=
                $form->field($model, 'date_of_birth')->widget(
                        DatePicker::class,
                        [
                            'clientOptions' => [
                                'format' => 'Y-m-d',
                                'todayHighlight' => true,
                                'autoclose' => true,
                            ],
                            'options' => ['class' => 'form-control']
                ])
                ?>
            </td>
            <td>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?> 
            </td>
            <td>
                <?= $form->field($model, 'primary_telephone')->textInput(['maxlength' => true]) ?> 
            </td>
        </tr>

        <tr>
            <td>
                <?= $form->field($model, 'secondary_telephone')->textInput(['maxlength' => true]) ?>
            </td>

            <td>
                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?> 
            </td>
            <td>
                <?= $form->field($model, 'member_pic')->textInput(['maxlength' => true]) ?>
            </td>
        </tr>


        <tr>
            <td>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </td>
            <td colspan="2">
                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'sacco_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>

            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>
