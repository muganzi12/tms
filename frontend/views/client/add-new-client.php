<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\client\Member */

$this->title = 'Enter Details to Register a New client';
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
?>
<div class="member-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'ident' => $ident,
        'sex' => $sex,
        'marital' => $marital,
        'client' => $client,
        'office' => $office,
        'address' => $address,
        'classification' => $classification,
         'member' => $member,
    ])
    ?>

</div>
