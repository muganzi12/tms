
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Json;
/* @var $this yii\web\View */
/* @var $model common\models\BankClient */
$data = Json::decode($model);
$this->title = $data[0]['member_id_number'];
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
//$data = Json::decode($model);
$this->params['page_description'] = 'Members';
?>


    
   <table class="table table-striped">
    <tr>
        <th>
            Member ID Number
        </th>
        <td>
              <?= $data[0]['member_id_number']; ?>
        </td>
    </tr>
    <tr>
        <th>
            First Name
        </th>
        <td>
           <?= $data[0]['firstname']; ?>
        </td>
    </tr>
    <tr>
        <th>
         Last Name
        </th>
        <td>
             <?= $data[0]['lastname']; ?>
        </td>
    </tr>

    <tr>
        <th>
            Other Name
        </th>
        <td>
             <?= $data[0]['othername']; ?>
        </td>
    </tr>
        <tr>
        <th>
          Gender
        </th>
        <td>
            <?= $data[0]['gender']; ?>
        </td>
    </tr>
    
        <tr>
        <th>
          Marital Status
        </th>
        <td>
            <?= $data[0]['marital_status']; ?>
        </td>
    </tr>
    
         <tr>
        <th>
          Email
        </th>
        <td>
            <?= $data[0]['email']; ?>
        </td>
    </tr>

       <tr>
        <th>
          Primary Telephone
        </th>
        <td>
            <?= $data[0]['primary_telephone']; ?>
        </td>
    </tr>
    
      <tr>
        <th>
          Primary Telephone
        </th>
        <td>
            <?= $data[0]['secondary_telephone']; ?>
        </td>
    </tr>
       <tr>
        <th>
          Primary Telephone
        </th>
        <td>
            <?= $data[0]['address']; ?>
        </td>
    </tr>
    
       <tr>
        <th>
          Primary Telephone
        </th>
        <td>
            <?= $data[0]['sacco']['name']; ?>
        </td>
    </tr>
</table> 

<pre>
    <?= print_r($data);?>
</pre>