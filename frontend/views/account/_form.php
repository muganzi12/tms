<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\masterdata\ChartOfAccounts;
?>

<div class="chart-of-accounts-form">

<?php $form = ActiveForm::begin(); ?>
    <table class="table">
        <tr>
            <td style="width:50%">
                <?php
                echo $form->field($model, 'account_type')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($type, 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select Account Type',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required'=>true
                    ],
                ]);
                ?>
            </td>
            <td>
            <?php
                echo $form->field($model, 'parent_id')->widget(Select2::classname(), [
                    'value' => '',
                    'theme' => Select2::THEME_CLASSIC,
                    'data' => ArrayHelper::map($chartofaccounts, 'id', 'account_name','type.name'),
                    'options' => [
                        'placeholder' => 'Select Parent Account',
                        'class' => 'form-control',
                        'multiple' => false,
                        'required'=>true
                    ],
                ]);
                ?>
            </td>
        </tr>
        <tr>
            <td><?= $form->field($model, 'gl_code')->textInput(['required'=>true]) ?></td>
            <td> <?= $form->field($model, 'account_name')->textInput(['maxlength' => true,'required'=>true]) ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <?= $form->field($model, 'description')->textArea(['maxlength' => 300, 'rows' => 6, 'cols' => 50,'required'=>true]) ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= Html::submitButton(($model->id > 0) ? ('Update') : ('Save'), ['class' => ($model->id > 0) ? ('btn btn-success btn-block') : ('btn btn-primary btn-block'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td>
                <?= $form->field($model, 'created_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'updated_by')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'category')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>

