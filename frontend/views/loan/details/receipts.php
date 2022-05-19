<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\client\Member */

$this->title = $model->firstname . ' ' . $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
\yii\web\YiiAsset::register($this);
?>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="info">
            <th>S/N</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Identification type</th>
            <th>Identification Number</th>
            <th>Relationship</th>
            <th>Gender</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Address</th>

        </tr>
    </thead>
    <tbody>

    <tbody>
        <?php
        $i = 1;
        foreach ($model->nextOfKin AS $kin) {
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $kin->firstname; ?></td>
                <td><?= $kin->lastname; ?></td>
                <td><?= $kin->identificationType->name; ?></td>
                <td><?= $kin->identification_number; ?></td>
                <td><?= $kin->relationshipType->name; ?></td>
                <td><?= $kin->genderType->name; ?></td>
                <td><?= $kin->email; ?></td>
                <td><?= $kin->telephone; ?></td>
                <td><?= $kin->address; ?></td>

            </tr>
        <?php } ?>
    </tbody>
</table>
