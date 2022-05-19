<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\client\Member */

$this->title = $model->firstname . ' ' . $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
$loggedIn = Yii::$app->user;
\yii\web\YiiAsset::register($this);
$kins=$_GET['id'];
?>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="info">
            <th>S/N</th>
            <th>Name</th>
            <th>Description</th>
            <th>File Name</th>
            
            <th>Option</th>

        </tr>
    </thead>
    <tbody>

    <tbody>
        <?php
        $i = 1;
        foreach ($model->supportingDocuments AS $doc) {
            ?>
            <tr>
               <td> <?= $i++ ?></td>
                <td><?= $doc->name; ?></td>
                <td><?= $doc->description; ?></td>
                <td><img src="<?= Url::to('@web/html/uploads/' . $doc->file_name); ?>" class="card-mg-top" width="30%"></td>

                <?php if ($loggedIn->can('Approving Authority')) {
                    ?>

                    <td colspan="6">
                        <?= '<b class="btn btn-success"><a href="' . Url::to(['client/update-document', 'id' => $doc->id, 'memb' => $kins]) . '">' . '<span style="color:#fff;font-size:85%;">Update ' . "</a></b>"; ?>

                        <?= '<b class="btn btn-danger"><a href="' . Url::to(['client/delete', 'id' => $doc->id, 'memb' => $kins]) . '">' . '<span style="color:#fff;font-size:85%;">Delete ' . "</a></b>"; ?>

                    </td>
                <?php } ?>


            </tr>
        <?php } ?>
    </tbody>
</table>
