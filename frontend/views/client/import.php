<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Import Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($modelImport, 'fileImport')->fileInput() ?>

<?= Html::submitButton('Import', ['class' => 'btn btn-primary']); ?>

<?php ActiveForm::end(); ?>