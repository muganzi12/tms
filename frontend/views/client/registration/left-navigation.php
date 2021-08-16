<?php

use yii\helpers\Url;

/*
 * Navigation for a file
 */
?>
<ul class="right-nav-list">
    <li>
        <a href="<?= Url::to(['client/update', 'id' => $model->id]); ?>"><i class="fa fa-pencil"></i> Edit Client details</a>
    </li>
    <li>
        <a href="<?= Url::to(['client/upload-photo', 'id' => $model->id]); ?>"><i class="fa fa-upload"></i> Upload Passport Photo</a>
    </li>
    <li>
        <a href="<?= Url::to(['client/upload-document', 'id' => $model->id]); ?>"><i class="fa fa-upload"></i> Upload Document</a>
    </li>
    <li>
        <a href="<?= Url::to(['loan/new-loan-application', 'id' => $model->id]); ?>"><i class="fa fa-plus-circle"></i> Schedule Loan</a>
    </li>

    <li class="title">CLIENT PARTIES</li>
    <li><a href="<?= Url::to(['client/add-next-of-kin', 'id' => $model->id]) ?>"><i class="ti-user"></i> New Next of Kin</a></li>

    <li class="title">Loan Manager</li>
    <li><a href="<?= Url::to(['client/reject-client', 'id' => $model->id]) ?>"><i class="fa fa-lg fa-fw fa-info-circle"></i>Reject Client</a></li>

    <li><a href="<?= Url::to(['client/approve-client', 'id' => $model->id]) ?>"><i class="fa fa-lg fa-fw fa fa-check"></i>Approve Client</a></li>


</ul>