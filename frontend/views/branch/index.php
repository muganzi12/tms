<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\BranchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
//Page descrition
$this->params['page_description'] = '';
?>
<div class="branch-index">

    <p>
        <?= Html::a('New Branch', ['add-new-branch'], ['class' => 'btn btn-success pull-right']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'client_id',
            'mobile_telephone',
            'office_telephone',
            'address',
            
             [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->branchStatus->css_class . '">' . $data->branchStatus->name . '</a>';
                },
                'format' => 'raw'
            ],
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

               [
                'format' => 'raw',
                'value' => function($data) {
                    return
                    Html::a('<span class="glyphicon glyphicon-pencil"></span> Update', ['update', 'id' => $data['id']], ['title' => 'edit', 'class' => 'btn btn-info']);
                },
                'header' => 'OPTIONS'
            ],
        ],
    ]); ?>


</div>
