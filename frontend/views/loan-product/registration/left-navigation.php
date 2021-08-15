<?php

use yii\helpers\Url;

/*
 * Navigation for a file
 */
?>
<ul class="right-nav-list">
    <li>
        <a href="<?= Url::to(['loan-product/specify-document-required', 'id' => $model->id]); ?>"><i class="fa fa-plus-circle"></i>Required Documents</a>
    </li>



</ul>