<?php

use yii\helpers\Url;

/*
 * Navigation for a file
 */
?>
<ul class="right-nav-list">
    <li>
        <a href="<?= Url::to(['account/add-new-account', 'id' => $model->id]); ?>"><i class="fa fa-plus-circle"></i>Add a New Account</a>
    </li>



</ul>