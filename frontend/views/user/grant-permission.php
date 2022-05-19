<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/*
 * Grant Permission to a given group
 */
$auth = Yii::$app->authManager;
$role = $auth->getRole($id);

$this->title = "Grant Permissions to the {$role->name} group";
//Permissions
$access = $auth->getPermissions();
$this->params['page_description'] = "New User Group";
?>
<style>
    label{
        display:block;
        font-style: normal !important;
        font-size: 110%;
    }
</style>
<div class="permission-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'children')->checkboxList(ArrayHelper::map($access, 'name', 'description'))->label(false) ?> 
    <?= $form->field($model, 'parent')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Grant Permissions', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
