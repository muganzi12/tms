<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Institution;
use yii\helpers\Url;
use yii\rbac\DbManager;
use common\models\OfficeHeld;
use kartik\select2\Select2;
use common\models\rbac\AuthItem;
$auth = new DbManager();
?>

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="user-form">
    <table class="table">
  
        <td colspan="6">
            <?php
      
            echo $form->field($model, 'item_name')->widget(Select2::classname(), [
                'value' => '',
                'theme' => Select2::THEME_CLASSIC,
                'data' => ArrayHelper::map(AuthItem::find()->select(['id', 'name'])->all(), 'name', 'name'),
                'options' => [
                    'placeholder' => 'Select Permission/Role',
                    'class' => 'form-control',
                    'multiple' => false,
                    'required'=>true
                ]
            ]);
            ?>
        </td>
    

        <tr>

            <td></td><td></td>
            <td>
                <?= $form->field($model, 'created_at')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'user_id')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false); ?> 

            </td>
        </tr>

        <tr>
            <td>
                <?= Html::submitButton(($model->id > 0) ? ('Update') : ('Save'), ['class' => ($model->id > 0) ? ('btn btn-success') : ('btn btn-primary'), 'style' => 'margin-top:30px;']) ?>
            </td>
            <td colspan="3"></td>
        </tr>
    </table>
        </div>
    </div>

</div>
<?php ActiveForm::end(); ?>
