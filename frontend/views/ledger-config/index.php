<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Ledger transaction configuration';
//Top Right button
$this->params['topright_button'] = false;
$this->params['topright_button_label'] = 'New Configuration';
$this->params['topright_button_link'] = ['ledger-config/create'];
$this->params['topright_button_class'] = 'btn btn-success my-2 my-sm-0';
?>
<div class="ledger-transaction-config-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'transaction_name',
            [
                'attribute'=>'debit_account',
                'value'=>function($data){
                    return $data->debitAccount->fullAccountName;
                }
            ],
            [
                'attribute'=>'credit_account',
                'value'=>function($data){
                    return $data->creditAccount->fullAccountName;
                }
            ],
            'amount_rule',
            'amount:currency',
            [
                'attribute'=>'product_id',
                'value'=>function($data){
                    if($data->product_type=='ADMIN'){
                        return $data->product_type;
                    }else{
                        return $data->product."<br/><badge class='badge badge-primary ml-auto'>{$data->product_type}</badge>";
                    }
                },
                'format'=>'raw'
            ],
            //'is_primary',
            //'parent_id',
            //'created_at',
            //'created_by',
            //'updated_by',
            //'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
