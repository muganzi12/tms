<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Client";
//Page descrition
$this->params['page_description'] = 'Clients';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Client';
$this->params['topright_button_link'] = ['client/add-new-client'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="member-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'reference_number',
                'value' => function($data) {
                    return '<b><a href="' . Url::to(['client/view', 'id' => $data->id]) . '">' . $data->reference_number . "</a></b>";
                },
                'format' => 'raw'
            ],
            'firstname',
            'lastname',
            [
                'attribute' => 'identification_type',
                'value' => function($data) {
                    return $data->identification_number.'<br/><badge class="badge badge-secondary">'.$data->identificationType->name.'</badge>';
                },
                'format' => 'raw'
            ],
            'telephone',
            // 'alt_telephone',
            [
                'attribute' => 'gender',
                'value' => function($data) {
                    return $data->genderType->name;
                },
                'format' => 'raw'
            ],
            //'email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->memberStatus->css_class . '">' . $data->memberStatus->name . '</a>';
                },
                'format' => 'raw'
            ],
            [
                'format' => 'raw',
                'value' => function($data) {
                    return
                    Html::a('<span class="glyphicon glyphicon-pencil"></span> Update', ['update', 'id' => $data['id']], ['title' => 'edit', 'class' => 'btn btn-info']);
                },
                'header' => 'OPTIONS'
            ],
                        ],
    ]);
    ?>


</div>
