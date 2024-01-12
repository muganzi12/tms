<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\account\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Permissions";
//Page descrition
$this->params['page_description'] = 'Permissions';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Permission';
$this->params['topright_button_link'] = ['auth-item/add-new-permission'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="auth-item-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        'name',
        'type',
        'description:ntext',
        'rule_name',
        //'data',
        //'created_at',
        //'updated_at',
        //'module',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>


</div>
