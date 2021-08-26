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
                        'attribute' => 'file_name',
                        'format' => 'html',
                        'value' => function($data) {
                            return
                            Html::a('Download File', '#' . $data->file_name, ['class' => 'btn btn-secondary btn-sm', 'download' => true]);
                        }
                    ],
                ],
            ]);
            ?>
        </div>

    </div>
