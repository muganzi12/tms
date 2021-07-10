
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Json;
/* @var $this yii\web\View */
/* @var $model common\models\BankClient */
$data = Json::decode($model);
$this->title = $data[0]['username'];
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
//$data = Json::decode($model);
$this->params['page_description'] ='';
?>


    
   <table class="table table-striped">
    <tr>
        <th>
            User Name
        </th>
        <td>
              <?= $data[0]['username']; ?>
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
          Telephone
        </th>
        <td>
            <?= $data[0]['telephone']; ?>
        </td>
    </tr>
    
        <tr>
        <th>
          SACCO
        </th>
        <td>
            <?= $data[0]['sacco']['name']; ?>
        </td>
    </tr>
    
         <tr>
        <th>
          Branch
        </th>
        <td>
            <?= $data[0]['branch']['name']; ?>
        </td>
    </tr>

    
</table> 

<pre>
    <?= print_r($data);?>
</pre>