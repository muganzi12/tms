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

<div class="row">
  <div class="col-lg-12">
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