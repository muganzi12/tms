<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = $model->client->firstname.' '.$model->client->lastname;
//Page descrition
$this->params['page_description'] = 'Chart of Accounts';
?>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="info">
            <th>S/N</th>
            <th>Name</th>
            <th>ID Number</th>
            <th>Gender</th>
            <th>Telephone</th>
            <th>Address</th>

        </tr>
    </thead>
    <tbody>

    <tbody>
        <?php
        $i = 1;
        foreach ($model->loanGuarantor AS $grt) {
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $grt->firstname.' '.$grt->lastname; ?></td>
                <td><?= $grt->identification_number; ?></td>
                <td><?= $grt->genderType->name; ?></td>
                <td><?= $grt->telephone_primary; ?></td>
                <td><?= $grt->physical_address; ?></td>

            </tr>
        <?php } ?>
    </tbody>
</table>