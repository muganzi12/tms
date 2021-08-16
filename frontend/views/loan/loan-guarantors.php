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
<style>
    .profile-section{}
    .profile-section h5{
        border-bottom: 3px solid #3C8BE5;
        color:#135095;
        font-weight: bold !important;
    }
</style>
<section class="sheet padding-10mm" style="padding:0 7px 0 7px;">
    <?= $this->render('details/page-header_loan', ['model' => $loan, 'active_menu' => 'guarantor']); ?>
      <?= $this->render('registration/reg-steps-top-nav',['model'=>$loan,'active'=>'guarantor']); ?>
      <div class="profile-section" style="margin-top:20px;">

        <div class="col-lg-10" style="padding:0px;">


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
    <div class="col-lg-2" style="padding:12px;">
        <?= $this->render('registration/left-navigation', ['model' => $loan, 'active' => 'summary']); ?>            
    </div>
</div>
