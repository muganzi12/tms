<?php

use yii\helpers\Url;

/*
 * Navigation for a file
 */
?>
<ul class="right-nav-list">
    <li>
        <a href="<?= Url::to(['loan/update', 'id' => $model->id]); ?>"><i class="fa fa-pencil"></i> Update Loan Details</a>
    </li>
    <li>
        <a href="<?= Url::to(['loan/add-loan-guarantor', 'id' => $model->id]); ?>"><i class="fa fa-plus-circle"></i> Add Loan Guarantor</a>
    </li>
    <li>
        <a href="<?= Url::to(['loan/add-loan-collateral', 'id' => $model->id]); ?>"><i class="fa fa-upload"></i> Add Loan Collateral</a>
    </li>
    <?php
    if ($model->status == 19) {
        ?>
        <li>
            <a href="<?= Url::to(['loan/approve-loan-application', 'id' => $model->id]); ?>"><i class="fa fa-pencil"></i> Approve a Loan Application</a>
        </li>
    <?php } ?>
    <?php
    if ($model->status == 19) {
        ?>
        <li>
            <a href="<?= Url::to(['loan/reject-loan-application', 'id' => $model->id]); ?>"><i class="fa fa-pencil"></i> Reject a Loan Application</a>
        </li>
    <?php } ?>
    <?php
    if ($model->status == 20) {
        ?>
        <li>
            <a href="<?= Url::to(['loan/disburse-loan', 'id' => $model->id,'stage'=>$stage]); ?>"><i class="fa fa-paint-brush"></i> Disburse Loan</a>
        </li>
    <?php } ?>

</ul>