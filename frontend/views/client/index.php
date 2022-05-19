<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use nullref\datatable\DataTable;
/* @var $this yii\web\View */
/* @var $searchModel common\models\client\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Clients";
//Page descrition
$this->params['page_description'] = 'Clients';
$loggedIn = Yii::$app->user;
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


<table id="example" class="display" style="width:100%">
    <thead>
   
        <tr>
            <th>Passport</th>
            <th>File Number</th>
            <th>Client Name</th>
            <th>ID Type</th>
            <th>Telephone</th>
            <th>Client Type</th>
             <th>Classification</th>
            <th>Status</th>
        </tr>
  
    </thead>
    <tbody>
               <?php foreach ($data AS $lg) { ?>
        <tr>
            <td><?=@$lg['profile'];?></td>
            <td><?=@$lg['accountNumber'];?></td>
            <td><?=@$lg['fullNames'];?></td>
            <td><?=@$lg['identification'];?></td>
            <td><?=$lg['telephone'];?></td>
            <td><?=@$lg['clientTypes'];?></td>
              <td><?=@$lg['clientClassificationStatus'];?></td>
            <td><?=@$lg['statusButton'];?></td>
        </tr>
          <?php } ?>
 
     
    </tbody>

</table>
    <pre>
        <?php  print_r($data);?>
    </pre>
