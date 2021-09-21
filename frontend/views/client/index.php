<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Clients";
//Page descrition
$this->params['page_description'] = 'Clients';

//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Client';
$this->params['topright_button_link'] = ['client/add-new-client'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="member-index">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'passport_photo',
                'label' => 'Passport',
                'format' => 'raw',
                'value' => function ($data) {
                    $url = $data->passportPhoto;
                    return Html::img($url, ['alt' => 'table-img', 'width' => '50', 'height' => '50']);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'account_number',
                'value' => function($data) {
                    return '<b><a href="' . Url::to(['client/view', 'id' => $data->id]) . '">' . $data->account_number . "</a></b>";
                },
                'format' => 'raw'
            ],
            [
                
                'attribute' => 'firstname',
                'header' => 'Client Name',
                'value' => function($data) {
                    return $data->firstname . ' ' . $data->lastname;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'identification_type',
                'value' => function($data) {
                    return $data->identification_number . '<br/><badge class="badge badge-secondary">' . $data->identificationType->name . '</badge>';
                },
                'format' => 'raw'
            ],
            'telephone',
            [
                'attribute' => 'gender',
                'value' => function($data) {
                    return $data->genderType->name;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->memberStatus->css_class . '">' . $data->memberStatus->name . '</a>';
                },
                'format' => 'raw'
            ],
        // [
        //     'format' => 'raw',
        //     'value' => function($data) {
        //         return
        //         Html::a('<span class="glyphicon glyphicon-pencil"></span> Update', ['update', 'id' => $data['id']], ['title' => 'edit', 'class' => 'btn btn-info']);
        //     },
        //     'header' => 'OPTIONS'
        // ],
        ],
    ]);
    ?>


</div>