<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Add a New Account';
$this->params['breadcrumbs'][] = ['label' => 'Chart Of Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-lg-3">
        <a href="<?= Url::to(['account/add-new-account']);?>" class="btn btn-success mb-3 btn-block"><i class="material-icons">add_circle_outline</i> New Account</a>
        <ul class="list-group">
            <li class="list-group-item active"><a href="#" class="text-white"><i class="material-icons">dehaze</i><strong> All Headers</strong></a></li>
            <li class="list-group-item"><a href="#"><i class="material-icons">description</i><strong>10000</strong> - Assets</a></li>
            <li class="list-group-item"><a href="#"><i class="material-icons">description</i><strong>20000</strong> - Liabilities</a></li>
            <li class="list-group-item"><a href="#"><i class="material-icons">description</i><strong>30000</strong> - Equity</a></li>
            <li class="list-group-item"><a href="#"><i class="material-icons">description</i><strong>40000</strong> - Revenue</a></li>
            <li class="list-group-item"><a href="#"><i class="material-icons">description</i><strong>50000</strong> - Expense</a></li>
        </ul>
    </div>
    <div class="col-lg-9" style="padding:0px;"> 
    <?= $this->render('_form', [
        'model' => $model,
        'type'=>$type,
        'chartofaccounts'=>$chartofaccounts
    ]) ?>
</div>
</div>

