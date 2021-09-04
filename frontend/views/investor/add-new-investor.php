<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Investor */

$this->title = 'Register a New Investor';
$this->params['breadcrumbs'][] = ['label' => 'Investors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investor-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'ident' => $ident,
        'sex' => $sex,
    ])
    ?>

</div>
