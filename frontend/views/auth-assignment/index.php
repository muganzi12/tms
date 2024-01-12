<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\account\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Permissions";
//Page descrition
$this->params['page_description'] = 'Permissions';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'Assign Permission';
$this->params['topright_button_link'] = ['auth-assignment/add-new-permission'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="auth-assignment-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        'item_name',
        'user_id',
        'created_at',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>


</div>
