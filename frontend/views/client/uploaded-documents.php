<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Supporting Documents';
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
//Pass CLientID to the layout 
$this->params['client_id'] = $clientId;
?>
<style>
    .profile-section{}
    .profile-section h5{
        border-bottom: 3px solid #3C8BE5;
        color:#135095;
        font-weight: bold !important;
    }
</style>
<section class="sheet padding-10mm" style="padding:0 7px 0 7px;">

    <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-12" style="padding:0px;">


            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    'name',
                    'description',
                    [
                        'attribute' => 'name',
                        'header' => 'File Name',
                        'value' => function($data) {
                            return "<div class='fa fa-file-pdf-o' style='color:red'><img src='" . "'style='height:80px;'>&nbsp;" .
                            Html::a($data->name, ['client/pick-document', 'id' => $data->id], ['download' => true]);
                        },
                        'headerOptions' => ['style' => 'width:400px;color:#000;'],
                        'format' => 'raw'
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{delete} {update}',
                        'urlCreator' => function($action, $model, $key, $index) {
                            return Url::to([$action, 'id' => $key]);
                        },
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                $docs = $_GET['id'];
                                return Html::a('<span style="font-size:85%;"><i class="fa fa-delete" style="color:#444;"></i></span><br/>', ['delete', 'id' => $model->id, 'memb' => $docs], ['title' => 'Delete']);
                            },
                            'update' => function ($url, $model, $key) {
                                $doc = $_GET['id'];
                                return Html::a('<span style="font-size:85%;"><i class="fa fa-edit" style="color:green;"></i></span>', ['update-document', 'id' => $model->id, 'memb' => $doc], ['title' => 'Update']);
                            },
                            'delete' => function ($url, $model, $key) {
                                $doc = $_GET['id'];
                                return Html::a('<span style="font-size:85%;"><i class="fa fa-trash" style="color:red;"></i></span>', ['delete', 'id' => $model->id, 'memb' => $doc], ['title' => 'Update']);
                            },
                        ],
                    ],
                ],
            ]);
            ?>
        </div>

    </div>
