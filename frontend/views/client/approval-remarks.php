<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\LoanManagerRemarksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Client Approval Remarks';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('registration/reg-steps-top-nav', ['model' => $client, 'active' => 'approve']); ?>

<div class="row">  
    <div class="col-lg-10" style="padding:0px;"> 

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],

                'remarks',
        
            ],
        ]);
        ?>



    </div>
    <div class="col-lg-2" style="padding:12px;">
<?= $this->render('registration/left-navigation', ['model' => $client, 'active' => 'summary']); ?>            
    </div>
</div>

