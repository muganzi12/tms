<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Transaction Types';
//Top Right button
$this->params['topright_button'] = false;
$this->params['topright_button_label'] = 'New Transaction Type';
$this->params['topright_button_link'] = ['transaction-type/create'];
$this->params['topright_button_class'] = 'btn btn-success my-2 my-sm-0';

?>
<div class="ledger-transaction-type-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'description',
            [
                'attribute'=>'is_split',
                'value'=>function($data){
                    return ($data->is_split==1)?('Yes'):('No');
                }
            ],
            //'module_id',
            //'created_by',
            'created_at:date',
            //'updated_by',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['style' => 'width: 100px'],
            'template'=>'{update}',
              'buttons'=>[
                'update'=>function ($url, $model) {
                   return Html::a('<i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">edit</i> Edit', ['transaction-type/update','id'=>$model->id]);
                },
              ],
        ],
        ],
    ]); ?>
</div>
