<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Required Documents';
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_description'] = '';
?>
<?= $this->render('registration/reg-steps-top-nav', ['model' => $client, 'active' => 'doc']); ?>

<div class="row">

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
            ],
        ]);
        ?>
    </div>
    <div class="col-lg-2" style="padding:12px;">
        <?= $this->render('registration/left-navigation', ['model' => $client, 'active' => 'summary']); ?>            
    </div>
</div>