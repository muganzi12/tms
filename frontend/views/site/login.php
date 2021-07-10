<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


$this->title = 'Login to your account';
?>

<section class="auth-section login-section text-center py-5">
    <div class="container">
        <div class="auth-wrapper mx-auto shadow p-5 rounded" style="background:#ffff">
            <span class="icon-holder"><img src="https://media.kumusoft.com/logo.png" alt="" style='height:90px;'></span>
            <div class="divider my-5">
                <span class="or-text">KMS</span>
            </div><!--//divider-->

            <div class="auth-form-container text-left mx-auto">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'class' => 'auth-form login-form'
                ]);
                ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?=
                $form->field($model, 'rememberMe')->checkbox([
                        //'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ])
                ?>
                <?= Html::submitButton('Login', ['class' => 'btn btn-dark btn-block', 'name' => 'login-button']) ?>
                <?php ActiveForm::end(); ?>
            </div><!--//auth-form-container-->

        </div><!--//auth-wrapper-->
    </div><!--//container-->
</section><!--//auth-section-->