<?php
use yii\helpers\Html;

$this->title = 'Update Member: ' . $model->firstname .' ' .$model->lastname;
$this->params['page_description'] = '';
//Pass CLientID to the layout 
$this->params['client_id'] = $model->id;
?>
<h2>Update profile information</h2>
<div class="row">
    <?=
    $this->render('_form', [
        'model' => $model,
        'ident' => $ident,
        'sex' => $sex,
        'marital' => $marital
    ])
    ?>
    </div>