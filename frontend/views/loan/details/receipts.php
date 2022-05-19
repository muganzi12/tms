<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\client\Member */

$this->title = $model->due_date;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
\yii\web\YiiAsset::register($this);
?>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="info">
            <th>S/N</th>
            <th>Ref</th>
            <th>Amount Paid</th>
            <th>Payment Date</th>
            <th>Paid By</th>
            <th>Receipt</th>

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
              <td><?= $doc->reference_no; ?></td>
              <td><?= $doc->amount_paid; ?></td>
              <td><?= $doc->payment_date; ?></td>
              <td><?= $doc->paid_by; ?></td>
              <td><img src="<?= Url::to('@web/html/payments/'.$doc->proof_attachment);?>" class="card-mg-top" width="100%"></td>
      
            </tr>
<?php } ?>
    </tbody>
</table>


