<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\rbac\DbManager;
use common\models\OfficeHeld;
use common\models\client\Branch;

$auth = new DbManager();
$new_link = "user/new-admin";
$update_link = "user/update";
?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="user-form">
            <table class="table">
                <tr>

                    <td>
<?= $form->field($model, 'firstname')->textInput() ?>  
                    </td>
                    <td><?= $form->field($model, 'lastname')->textInput() ?>
                    </td>
                    <td>
<?= $form->field($model, 'username')->textInput() ?>  
                    </td>

                </tr>
                <tr>
                    <td><?= $form->field($model, 'othername')->textInput() ?></td>
                    <td><?= $form->field($model, 'email')->textInput() ?></td>
                    <td><?= $form->field($model, 'telephone')->textInput() ?></td>


                </tr>


                <tr>

                    <td >
                        <?php
                        echo $form->field($model, 'office_id')->widget(Select2::classname(), [
                            'value' => '',
                            'theme' => Select2::THEME_CLASSIC,
                            'data' => ArrayHelper::map(OfficeHeld::find()->select(['id', 'name'])->all(), 'id', 'name'),
                            'options' => [
                                'placeholder' => 'Select Office Held',
                                'class' => 'form-control',
                                //'id' => 'user-outlet-id',
                                'multiple' => false,
                                'required' => true
                            ]
                        ]);
                        ?>
                    </td>

                    <td>
                        <?=
                        $form->field($model, 'status')->radioList(
                                [1 => 'Active', 2 => 'De-activated']
                        )
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <?= $form->field($model, 'user_groups')->checkboxList(ArrayHelper::map($auth->getRoles(), 'name', 'description')); ?>
                    </td>
                </tr>

                <tr>

                    <td></td><td></td>
                    <td>
                        <?= $form->field($model, 'id')->hiddenInput()->label(false); ?> 
                        <?= $form->field($model, 'created_at')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'created_by')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'is_admin')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'app_module')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'password_hash')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'client_id')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'password_status')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'updated_at')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'auth_key')->hiddenInput()->label(false); ?>


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
