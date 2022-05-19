<?php
/* 
 *Edit own profile details
 */
$this->title="Update your profile";
?>
<div class="row">
    <div class="col-lg-3">       
        <?= $this->render('left-navigation'); ?>
    </div>
    <div class="col-lg-9" style="padding-left:0px;">
       <?= $this->render('_edit-form',['model'=>$model])?>
    </div>
</div>