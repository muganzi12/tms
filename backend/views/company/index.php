<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
//Top Right button
$this->params['topright_button'] = true;
$this->params['topright_button_label'] = 'New Company';
$this->params['topright_button_link'] = ['company/add-new-client'];
$this->params['topright_button_class'] = 'btn-success pull-right';
?>
<div class="client-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute' => 'name',
                'value' => function($data) {
                    return '<b><a href="' . Url::to(['company/view', 'id' => $data->id]) . '">' . $data->name . "</a></b>";
                },
                'format' => 'raw'
            ],
            'brn',
            'code',
            //'contact_person',
            'office_telephone',
            'mobile_tephone',
            'email:email',
            // 'website',
            'address',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->clientStatus->css_class . '">' . $data->clientStatus->name . '</a>';
                },
                'format' => 'raw'
            ],
        //'logo_pic',
        //'created_at',
        //'created_by',
        //'updated_at',
        //'updated_by',
        //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
