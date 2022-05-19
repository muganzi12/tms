<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\client\LoanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <?php
    $form = ActiveForm::begin([
                'action' => ['loan/loan-interest'],
                'method' => 'get',
                'options' => ['style' => 'width:100%']
    ]);
    ?>
    <div class="col-lg-6">
        <?php
        echo '<div class="drp-container">';
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
                'placeholder' => 'Select invoice Period...'
            ]
        ]);
        echo '</div>';
        ?>
    </div>
  
    <div class="col-lg-3">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success btn-block', 'style' => '']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>