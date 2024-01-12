<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\property\PropertyUnitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-unit-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]);?>

    <?=$form->field($model, 'id')?>

    <?=$form->field($model, 'name')?>

    <?=$form->field($model, 'unit_number')?>
    <?=$form->field($model, 'rate')?>

    <?=$form->field($model, 'status')?>

    <?=$form->field($model, 'unit_type')?>

    <?php // echo $form->field($model, 'crated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?=Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
