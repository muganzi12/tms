
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model common\models\BankClient */
$data = Json::decode($sacco);
$this->title = $data['name'];
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
//$data = Json::decode($model);
//Page descrition
$this->params['page_description'] = '';
?>



<table class="table table-striped">
    <tr>
        <th>
            Name
        </th>
        <td>
            <?= $data['name']; ?>
        </td>
    </tr>
    <tr>
        <th>
            BRN
        </th>
        <td>
            <?= $data['brn']; ?>
        </td>
    </tr>

    <tr>
        <th>
            Telephone
        </th>
        <td>
            <?= $data['telephone']; ?>
        </td>
    </tr>

    <tr>
        <th>
            Address
        </th>
        <td>
            <?= $data['address']; ?>
        </td>
    </tr>

</table> 

<pre>
    <?= print_r($data); ?>
</pre>