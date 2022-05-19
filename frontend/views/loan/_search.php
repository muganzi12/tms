<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $model common\models\client\InvestorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="investor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['loan-interest'],
        'method' => 'get',
    ]); ?>
<table class='table'>
    <tr>
        <td>
       <?php
        echo DateRangePicker::widget([
            'name' => 'due_date',
            'presetDropdown' => true,
            'convertFormat' => true,
            'includeMonthsFilter' => true,
            'pluginOptions' => [
                'locale' => [
                    'format' => 'Y-m-d',
                    'separator' => ' to ',
                ]
            ],
            'options' => [
                'placeholder' => 'Select Due Date...'
            ]
        ]);
        ?>
    </td>
    <td>
   <?= $form->field($model, 'entry_reference') ?>
    </td>
    </tr>
       <tr>
    
        <td>
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-block']) ?>
        </td>
        <td>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default btn-block']) ?>
        </td>
    </tr>
</table>
    <?php ActiveForm::end(); ?>

</div>

