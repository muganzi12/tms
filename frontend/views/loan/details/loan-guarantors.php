<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = "Loan Guarantors";
//Page descrition
$this->params['page_description'] = 'Chart of Accounts';
?>

<div class="row">  
    <div class="col-lg-12" style="padding:0px;"> 

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'loan_id',
                'firstname',
                'lastname',
                'othername',
                [
                    'attribute' => 'identification_type',
                    'value' => function($data) {
                        return $data->identificationType->name;
                    },
                    'format' => 'raw'
                ],
                'identification_number',
                'telephone_primary',
                'telephone_alternative',
                //'employer_name',
                'source_of_income',
                'physical_address',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
  
</div>
