<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\LoanManagerRemarksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Client Approval Remarks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">  
    <div class="col-lg-12"> 

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
</div>

