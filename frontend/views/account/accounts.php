<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = "Chart of Accounts";
//Page descrition
$this->params['page_description'] = 'Chart of Accounts';
?>
<?= $this->render('registration/reg-steps-top-nav', ['model' => $account, 'active' => 'account']); ?>

<div class="row">  
    <div class="col-lg-10" style="padding:0px;"> 

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'gl_code',
                'account_name',
                [
                    'attribute' => 'account_type',
                    'value' => function($data) {
                        return $data->type->name;
                    },
                    'format' => 'raw'
                ],
                'description',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
    <div class="col-lg-2" style="padding:12px;">
<?= $this->render('registration/left-navigation', ['model' => $account, 'active' => 'summary']); ?>            
    </div>
</div>
