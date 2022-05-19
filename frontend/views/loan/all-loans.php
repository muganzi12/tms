<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\client\MasterData;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\client\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loan Applications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute' => 'reference_number',
                'value' => function($data) {
                    return '<b><a href="' . Url::to(['loan/view', 'id' => $data->id]) . '">' . $data->reference_number . "</a></b>";
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'client_id',
                'value' => function($data) {
                    return $data->client->fullNames;
                },
                'format' => 'raw'
            ],
            //'loan_type',
            [
                'attribute' => 'amount_applied_for',
                'value' => function($data) {
                    return number_format($data->amount_applied_for);
                },
                'format' => 'raw'
            ],
            'application_date',
            //'disbursment_date',
            'interest_rate',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return '<a href="#" class="badge badge-block badge-' . $data->loanStatus->css_class . '">' . $data->loanStatus->name . '</a>';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'status',
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'data' => ArrayHelper::map(MasterData::find()->where(['reference_table'=>'status'])->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select Status ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
                'format' => 'raw'
            ],
        //'interest_frequency',
        //'installment_frequency',
        //'loan_period',
        // 'created_at',
        // 'created_by',
        //'updated_at',
        //'updated_by',
//            [
//                'header' => 'Options',
//                'value' => function($data) {
//                    $my = $data['status'];
//                    if ($my == 19) {
//                        $link = Url::to(['loan/approve-loan-application', 'id' => $data['id']]);
//                        $reject_link = Url::to(['loan/reject-loan-application', 'id' => $data['id']]);
//                        return "<a href='{$link}' class='btn btn-primary btn-sm' style='margin-right:10px;'></i>Approve</a>" .
//                                "<a href='{$reject_link}' class='btn btn-warning btn-sm'></i>Reject</a>";
//                    } else if ($my == 20) {
//                        $link = Url::to(['loan/view', 'id' => $data['id']]);
//                        return "<a href='{$link}' class='btn btn-success btn-rounded btn-sm'></i>View-Loan</a>";
//                    } else if ($my == 36) {
//                        $link = Url::to(['loan/view', 'id' => $data['id']]);
//                        return "<a href='{$link}' class='btn btn-primary btn-rounded btn-sm'></i>Rejected Loan</a>";
//                    }
//                   else if ($my == 41) {
//                        $link = Url::to(['loan/view', 'id' => $data['id']]);
//                        return "<a href='{$link}' class='btn btn-primary btn-rounded btn-sm'></i>View Loan</a>";
//                   }
//                },
//                'format' => "raw"
//            ],
        ],
    ]);
    ?>


</div>
