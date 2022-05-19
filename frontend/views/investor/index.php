<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use sergmoro1\modal\controllers\ModalController;

$this->title = "Investors";
//Page descrition
$this->params['page_description'] = 'Investors';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Investor';
$this->params['topright_button_link'] = ['investor/add-new-investor'];
$this->params['topright_button_class'] = 'btn-success pull-right';
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
            <th>Account Number</th>
            <th>Client Name</th>
            <th>ID Type</th>
            <th>ID Number</th>
            <th>Telephone</th>
             <th>Gender</th>
            <th>Status</th>
        </tr>
  
    </thead>
    <tbody>
               <?php foreach ($data AS $lg) { ?>
        <tr>
            <td><?=$lg['profile'];?></td>
            <td><?=$lg['accountNumber'];?></td>
            <td><?=$lg['fullNames'];?></td>
            <td><?=$lg['identification'];?></td>
            <td><?=$lg['identfication_number'];?></td>
            <td><?=@$lg['telephone'];?></td>
              <td><?=@$lg['clientGender'];?></td>
            <td><?=$lg['statusButton'];?></td>
        </tr>
          <?php } ?>
 
     
    </tbody>

</table>
    <pre>
        <?php  print_r($data);?>
    </pre>