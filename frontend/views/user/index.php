<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\client\Branch;
use yii\helpers\Url;
use nullref\datatable\DataTable;

$this->title = 'System Users';
//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New System User';
$this->params['topright_button_link'] = ['user/add-new-system-user'];
$this->params['topright_button_class'] = 'btn-success pull-right';
$inst = Yii::$app->member->client_id;
$this->title = 'System Users';
$this->params['breadcrumbs'][] = $this->title;
//Page descrition
$this->params['page_description'] = '';
$data = $dataProvider->getModels();
?>

<style>


    input[type="search"] {
        width:500px;
        border:1px solid green;
        padding:3px;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<div class="user-index">

</div>

<table id="example" class="display" style="width:100%">
    <thead>
   
        <tr>
            <th>Profile Picture</th>
            <th>Username</th>
            <th>First Name</th>
             <th>Last Name</th>
            <th>Telephobe Number</th>
            <th>Email</th>
             <th>Office</th>
            <th>Status</th>
             <th>Option</th>
        </tr>
  
    </thead>
    <tbody>
               <?php foreach ($data AS $lg) { ?>
        <tr>
            <td><?=$lg['profile'];?></td>
            <td><?=$lg['userNames'];?></td>
            <td><?=$lg['firstname'];?></td>
            <td><?=$lg['lastname'];?></td>
            <td><?=$lg['telephone'];?></td>
            <td><?=@$lg['email'];?></td>
              <td><?=@$lg['officeHeld'];?></td>
            <td><?=$lg['statusButton'];?></td>
             <td><?=$lg['updateButton'];?></td>
        </tr>
          <?php } ?>
 
     
        
    </tbody>

</table>
    <pre>
        <?php  print_r($data);?>
    </pre>