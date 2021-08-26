<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\InvestorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Investors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investor-index">
    <p>
        <?= Html::a('New Investor', ['add-new-investor'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'profile_pic',
                'label' => 'Passport',
                'format' => 'raw',
                'value' => function ($data) {
                    $url = $data->profile_pic;
                    return Html::img($url, ['alt' => 'table-img', 'width' => '50', 'height' => '50']);
                },
                'format' => 'raw'
            ],
            'firstname',
            'lastname',
            'othername',
            'identification_type',
            'identfication_number',
            'telephone',
            'physical_address',
            //'alt_telephone',
            'email:email',
            //'created_at',
            //'status',
            //'created_by',
            //'updated_at',
            //'updated_by',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
