<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\client\Member */

$this->title = $model->client->firstname.' '.$model->client->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
\yii\web\YiiAsset::register($this);
?>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="info">
            <th>S/N</th>
            <th>Name</th>
            <th>Description</th>
            <th>File Name</th>

        </tr>
    </thead>
    <tbody>

        <tbody>
        <?php
        $i = 1;
        foreach ($model->loanCollateral AS $doc) {
            ?>
            <tr>
              <td> <?= $i++ ?></td>
              <td colspan="6"><?= $doc->collateralType->name; ?></td>
              <td colspan="6"><?= number_format($doc->estimated_price); ?></td>
              <td colspan="6"><?= $doc->location; ?></td>
              <td><img src="<?= Url::to('@web/html/uploads/'.$doc->proof_of_ownership);?>" class="card-mg-top" width="200" height="100"></td>
      
            </tr>
<?php } ?>
    </tbody>
</table>
