<?php

use yii\helpers\Html;
use yii\helpers\Url;

/*
 * User Groups
 */
$this->title = "System User Groups";
$auth = Yii::$app->authManager;

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New User Group';
$this->params['topright_button_link'] = ['user/new-group'];
$this->params['topright_button_class'] = 'btn-success pull-right';
$inst = Yii::$app->member->client_id;
$this->title = 'System Users';
$this->params['breadcrumbs'][] = $this->title;
//Page descrition
$this->params['page_description'] = '';
$groups = $auth->getRoles();
?>

<table class="table table-bordered">
    <thead>
        <tr class="info">
            <th>S/N</th>
            <th>Group</th>
            <th>Description</th>
            <th>Options</th>
         
        </tr>
    </thead>
    <tbody>
       <?php 
        $i = 1;
       foreach ($groups AS $role) { ?>
            <tr>
                <td> <?= $i++ ?></td>
                <td> <a href="#"><?= $role->name; ?></a></td>
                <td><?= $role->description; ?> | <?= count($auth->getUserIdsByRole($role->name)) ?> Users  | <?= count($auth->getPermissionsByRole($role->name)); ?> Permissions</td>
                
                <td>
                                     <a href='<?= Url::to(['user/group-details', 'id' => $role->name]); ?>' class="btn btn-sm btn-icon btn-success"><i class="fa fa-cog"></i> Manage Group
                    </a>
                </td>
            </tr>
<?php } ?>
    </tbody>
</table>


