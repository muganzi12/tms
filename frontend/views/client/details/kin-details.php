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
            <th>First Name</th>
            <th>Last Name</th>
            <th>Telephone</th>
            <th>Email</th>
             <th>Option</th>
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
                <td><?= $kin->telephone; ?></td>
                <td><?= $kin->address; ?></td>
                
                    <?php if ($kin->status == 19) {
                        ?>
                        <?php if ($loggedIn->can('Approving Authority')) {
                           
                            ?>
                     
                            <td>
                                <?= '<b class="btn btn-success"><a href="' . Url::to(['client/update-next-of-kin', 'id' => $kin->id,'client'=>$kins]) . '">' . '<span style="color:#fff;font-size:85%;">Update ' . "</a></b>"; ?>
                                <?php if ($kin->status ==19) { ?>
                                    <?= '<b class="btn btn-danger"><a href="' . Url::to(['client/delete-kin', 'id' => $kin->id,'client'=>$kins]) . '">' . '<span style="color:#fff;font-size:85%;">Delete ' . "</a></b>"; ?>
                                <?php }
                                ?>
                            </td>
                        <?php } ?>
                    <?php }
                    ?>

            </tr>
        <?php } ?>
    </tbody>
</table>
