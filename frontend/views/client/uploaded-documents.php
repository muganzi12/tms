<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Next of Kin Details';
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
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
    <?= $this->render('details/page-header', ['model' => $model, 'active_menu' => 'upload']); ?>
      <?= $this->render('registration/reg-steps-top-nav',['model'=>$model,'active'=>'upload']); ?>
      <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-10" style="padding:0px;">


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
        <div class="col-lg-2" style="padding:12px;">
            <?= $this->render('registration/left-navigation', ['model' => $model, 'active' => 'summary']); ?>            
        </div>
    </div>
