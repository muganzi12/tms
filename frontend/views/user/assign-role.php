<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\User;

/*
 * Grant Permission to a given group
 */
$auth = Yii::$app->authManager;
$user = User::findOne($id);

$this->title = "Assign roles " . $user->fullnames;
//Permissions
$access = $auth->getRoles();
$this->params['page_description'] = 'Details of ' . $user->fullnames;
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
    <?=
    $form->field($model, 'roles')->checkboxList(
            ArrayHelper::map($access, 'name', 'description')
    )->label(false)
    ?> 
        <?= $form->field($model, 'user_id')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'created_at')->hiddenInput()->label(false); ?>
    <div class="form-group">
    <?= Html::submitButton('Assign Roles', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
