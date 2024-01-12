<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\location\DistrictSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Districts";
//Page descrition
$this->params['page_description'] = 'Districts';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New District';
$this->params['topright_button_link'] = ['district/add-new-district'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="district-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        'name',
        //'created_at',
        // 'created_by',
        //'updated_at',
        //'updated_by',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>


</div>
