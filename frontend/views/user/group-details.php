<?php

use common\models\User;
use yii\helpers\Url;

/*
 * Details of a given User group
 */
$this->title = "Group Details";
$this->params['hide_page_title'] = true;

$auth = Yii::$app->authManager;
$role = $auth->getRole($group);
$this->params['page_description'] = "New User Group";
?>
<div class="card card-fluid">
    <div class="card-header bg-twitter"> <h4><b><?= strtoupper($role->name); ?></b> | <small class='text-secondary'><?= $role->description; ?></small>
            <a href='<?= Url::to(['user/grant-permission', 'id' => $role->name]); ?>' class='btn btn-secondary pull-right'><i class='fa fa-plus-circle'></i> Grant new Permission</a>
        </h4> 
    </div>
    <div class="card-body">
        <h3> Users who have been assigned the <span class='text-primary'><?= strtoupper($role->name); ?></span> role </h3>
     
        <table class="table table-bordered">
            <thead>
                <tr class="info">
                    <th>S/N</th>
                    <th>Names</th>
                    <th>Date Registered</th>
                    <th>Options</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i= 1;
                foreach ($auth->getUserIdsByRole($role->name) AS $usr) {
                    $user = User::findOne($usr);
                    ?>
                    <tr>
                        <td> <?= $i++ ?></td>
                        <td> <span class="account-summary"><span class="account-name"><?= $user->fullnames; ?></span> 
                             <span class="account-description">@<?= $user->username; ?></span></span></td>
                          <td> <?= Yii::$app->formatter->asDate($user->created_at); ?> </td>
                        <td>
                            <a href='#'class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i> Remove from Group</a>
                        </td>
                    </tr>
<?php } ?>
            </tbody>
        </table>
        <h3 style='margin-top:50px;'> Permissions assigned to the <span class='text-primary'><?= strtoupper($role->name); ?></span> role</h3>
   
        
         <table class="table table-bordered">
            <thead>
                <tr class="info">
                    <th>S/N</th>
                    <th>Permission</th>
                    <th>Description</th>
                    <th>Options</th>

                </tr>
            </thead>
            <tbody>
               <?php 
               $i = 1;
               foreach ($auth->getPermissionsByRole($role->name) AS $perm) { ?>
                    <tr>
                        <td> <?= $i++ ?></td>
                        <td> <?= $perm->name; ?> </td>
                        <td> <?= $perm->description; ?> </td>
                        <td>
                            <a href='<?= Url::to(['user/revoke-permission', 'rl' => $role->name, 'id' => $perm->name]); ?>' class="btn btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i> Revoke Permission</a>
                        </td>
                    </tr>
          <?php } ?>
            </tbody>
        </table>
    </div>
</div>