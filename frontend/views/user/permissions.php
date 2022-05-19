<?php
use yii\rbac\DbManager;
/*
 * Groups and permissions
 */
$this->title = "Groups and Permissions";

$perm = new DbManager();
$groups = $perm->getRoles();
$this->params['page_description'] = "New User Group";
?>
<div class="col-12 col-lg-12" style="padding:0px;">
    <div class="card">
        <div class="card-header"><b>User groups and associated permissions</b> 
            <a href="#" class="btn btn-primary pull-right"><i class="mdi mdi-plus"></i> Grant permission</a>
        </div>
        <div class="tab-container tab-left" style="border-top:1px solid #ccc;">
            <ul class="nav nav-tabs" role="tablist">
                <?php foreach ($groups AS $role) { ?>
                    <li class="nav-item"><a class="nav-link <?= ($role->name=='admin')?('active show'):('');?>" href="#<?= $role->name; ?>" data-toggle="tab" role="tab" aria-selected="true"><?= $role->description; ?> </a></li>
                <?php } ?>
              </ul>
            <div class="tab-content" style="border-left:1px solid #ccc;">
                <?php foreach ($groups AS $role) {
                    $permissions = $perm->getPermissionsByRole($role->name);
                    ?>
                <div class="tab-pane <?= ($role->name=='admin')?('active show'):('');?>" id="<?= $role->name; ?>" role="<?= $role->name; ?>">
                    <h3><b>Permissions for</b> <u><?= $role->description; ?></u></h3>
                    <li class="list-group">
                        <?php foreach($permissions AS $pms){ ?>
                        <li><?= $pms->description; ?></li>
                        <?php } ?>
                    </li>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>