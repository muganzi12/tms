<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use common\models\Reports;
use yii\helpers\Url;
use Carbon\Carbon;
use yii\widgets\Pjax;
//Reports
$report = new Reports();
$this->title = "Dashboard";
$this->params['page_description'] = "Page Description here...";
//Top Performing 
$by_gender = $report->getClientByGender();
$plot = $report->getPricipalAmount2();
$total_of_clinets = array_sum(array_column($by_gender, 'total_number'));
?>
<style>
    .widget-style3{border:1px solid #999;}
</style>
  <?php Pjax::begin(['id' => 'cardsGrid']) ?>
<div class="row card-group-row">
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount"style="font-size:22px;"><?= $approved_clients['approved_clients']; ?></div>
                <div class="text-muted mt-1" style="font-size:12px;"><a href="<?= Url::to(['client/index']); ?>" class="text-muted mt-1">ACTIVE CLIENTS</a></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount" style="font-size:22px;"><?= $released_loans['released_loans']; ?></div>
                <div class="text-muted mt-1"style="font-size:12px;"><a href="<?= Url::to(['loan/disbursed-loan-applications']); ?>" class="text-muted mt-1">NUMBER OF LOANS</a></div>
      
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount" style="font-size:22px;"><?= number_format($total_loan_amount['total_loan_amount']); ?></div>
                <div class="text-muted mt-1"style="font-size:12px;"> AMONUT DISBURSED</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount" style="font-size:22px;"><?= number_format($total_principal_amount['total_principal_amount']); ?></div>
                <div class="text-muted mt-1" style="font-size:12px;"> TOTAL PRINCIPAL EXPECTED</div>
            </div>
        </div>
    </div>
</div>

<div class="row card-group-row">
       <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount" style="font-size:22px;"><?= number_format($principal_amount_paid['principal_amount_paid']); ?></div>
                <div class="text-muted mt-1" style="font-size:12px;"> PRINCIPAL PAID</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount" style="font-size:22px;"><?= number_format($total_interest_amount['total_interest_amount']); ?></div>
                <div class="text-muted mt-1" style="font-size:12px;"> INTEREST EXPECTED</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount" style="font-size:22px;"><?= number_format($loan_amount_paid['loan_amount_paid']); ?></div>
                <div class="text-muted mt-1" style="font-size:12px;"> INTEREST PAID</div>
            </div>
        </div>
    </div>
      
        <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount" style="font-size:22px;"><?= number_format($suspended_amount_paid['loan_suspended_amount']); ?></div>
                <div class="text-muted mt-1" style="font-size:12px;"> SUSPENDED INTEREST</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount" style="font-size:22px;"><?= number_format($total_principal_amount['total_principal_amount']-$principal_amount_paid['principal_amount_paid']); ?></div>
                <div class="text-muted mt-1" style="font-size:12px;"> TOTAL PRINCIPAL BALANCE</div>
            </div>
        </div>
    </div>
    
        <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount" style="font-size:22px;"><?= number_format($total_interest_amount['total_interest_amount']-$loan_amount_paid['loan_amount_paid']); ?></div>
                <div class="text-muted mt-1" style="font-size:12px;"> TOTAL INTEREST BALANCE</div>
            </div>
        </div>
    </div>
           <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount" style="font-size:22px;"><?= number_format($loan_penalty_amount['loan_penalty_amount']); ?></div>
                <div class="text-muted mt-1" style="font-size:12px;"> TOTAL PENALTY AMOUNT</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="flex">
                <div class="text-amount" style="font-size:22px;"><?= number_format(($total_principal_amount['total_principal_amount']-$principal_amount_paid['principal_amount_paid'])+($total_interest_amount['total_interest_amount']-$loan_amount_paid['loan_amount_paid'])); ?></div>
                <div class="text-muted mt-1" style="font-size:12px;"> TOTAL LOAN BALANCE</div>
            </div>
        </div>
    </div>

</div>


<div class="element-box" style='margin:10px;border:1px solid #ccc;'>
    <div class="element-info" style='border-bottom:1px solid #eee;margin-bottom: 5px;'>
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="element-info-with-icon">
                    <div class="element-info-text">
                        <!--<div class="element-inner-desc">This is a summary of Revenue performance of the Uganda Police Force</div>-->
                        <?php
                        $categorised = [];
                        foreach ($by_gender as $cat) {
                            $categorised[] = ['y' => intval($cat['total_number']), 'name' => $cat['name']];
                        }
                        echo Highcharts::widget([
                            'scripts' => [
                                'highcharts-3d',
                            ],
                            'options' => [
                                'chart' => [
                                    'type' => 'pie',
                                    'options3d' => [
                                        'enabled' => false,
                                        'alpha' => 45,
                                        'beta' => 0,
                                        'depth' => 20
                                    ]
                                ],
                                'title' => ['text' => 'Number of Clients By Gender'],
                                'subtitle' => [
                                    'text' => 'Source: LMS Online System'
                                ],
                                'series' => [
                                    [
                                        'name' => 'Gender',
                                        'color' => '#069',
                                        'data' => $categorised
                                    ]
                                ],
                                'credits' => ['enabled' => false],
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-lg-offset-2" style="padding-left: 30px;">
                <?=
                Highcharts::widget([
                    'options' => [
                        'chart' => [
                            'type' => 'column'
                        ],
                        'title' => ['text' => 'TOTAL NUMBER OF LOAN APPLICATIONS'],
                        'subtitle' => [
                            'text' => 'Generated By: LMS Online System'
                        ],
                        'xAxis' => [
                            'categories' => array_column($report->requetsByInstitution(), 'name'),
                            'crosshair' => true
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Number of Loan Applications']
                        ],
                        'series' => [
                                [
                                'name' => 'Disbursed',
                                'color' => '#069',
                                     'animation'=> false,
                                'data' => array_map('intval', array_column($report->requetsByInstitution(), 'Disbursed'))
                            ],
                            [
                                'name' => 'Pending',
                                'color' => '#ed8e09',
                                 'animation'=> false,
                                'data' => array_map('intval', array_column($report->requetsByInstitution(), 'Pending'))
                            ],
                              [
                                'name' => 'Approved',
                                'color' => '#6aa66a',
                                   'animation'=> false,
                                'data' => array_map('intval', array_column($report->requetsByInstitution(), 'Approved'))
                            ],
                              [
                                'name' => 'Rejected',
                                'color' => '#c96253',
                                   'animation'=> false,
                                'data' => array_map('intval', array_column($report->requetsByInstitution(), 'Rejected'))
                            ],
                          
                              [
                                'name' => 'Offset',
                                'color' => '#73b8f0',
                                   'animation'=> false,
                                'data' => array_map('intval', array_column($report->requetsByInstitution(), 'Offset'))
                            ],
                              [
                                'name' => 'Merged',
                                'color' => '#6bc9c8',
                                   'animation'=> false,
                                'data' => array_map('intval', array_column($report->requetsByInstitution(), 'Merged'))
                            ]
                           
                        ],
                        'credits' => ['enabled' => false],
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>

<div class="element-box" style='margin:10px;border:1px solid #ccc;'>
    <div class="element-info" style='border-bottom:1px solid #eee;margin-bottom: 5px;'>
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="element-info-with-icon">
                    <div class="element-info-text">
                       <?=
                Highcharts::widget([
                    'options' => [
                        'chart' => [
                            'type' => 'column'
                        ],
                        'title' => ['text' => 'INTEREST'],
                        'subtitle' => [
                            //'text' => 'Generated By: LMS Online System'
                        ],
                        'xAxis' => [
                            'categories' => array_column($report->getInterestAmount(), 'name'),
                            'crosshair' => true
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Amount']
                        ],
                        'series' => [
                            [
                                'name' => 'Expected',
                                'color' => '#ed8e09',
                                 'animation'=> false,
                                'data' => array_map('intval', array_column($report->getInterestAmount(), 'ExpextedInterest'))
                            ],
                                [
                                'name' => 'Paid',
                                'color' => '#6aa66a',
                                     'animation'=> false,
                                'data' => array_map('intval', array_column($report->getInterestAmount(), 'InterestPaid'))
                            ],
                                [
                                'name' => 'Not Paid',
                                'color' => '#c96253',
                                     'animation'=> false,
                                'data' => array_map('intval', array_column($report->getInterestNotPaid(), 'InterestNotPaid'))
                            ],
                          [
                                'name' => 'Suspended',
                                'color' => '#8be8e5',
                               'animation'=> false,
                                'data' => array_map('intval', array_column($report->getInterestAmount(), 'InterestSuspended'))
                            ]
                          
                        ],
                        'credits' => ['enabled' => false],
                    ]
                ]);
                ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-lg-offset-2" style="padding-left: 30px;">
                <?=
                Highcharts::widget([
                    'options' => [
                        'chart' => [
                            'type' => 'column'
                        ],
                        'title' => ['text' => ' PRINCIPAL'],
                        'subtitle' => [
                            //'text' => 'Generated By: LMS Online System'
                        ],
                        'xAxis' => [
                            'categories' => array_column($report->getPricipalAmount(), 'AmountDisbursed'),
                            'crosshair' => true
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Amount']
                        ],
                        'series' => [
                            [
                                'name' => 'Amount Disbursed',
                                 'animation'=> false,
                                'color' => '#069',
                                'data' => array_map('intval', array_column($report->getPricipalAmount2(), 'AmountDisbursed'))
                            ],
                            [
                                'name' => 'Expected',
                                'color' => '#ed8e09',
                                 'animation'=> false,
                                'data' => array_map('intval', array_column($report->getPricipalAmount2(), 'ExpextedPrincipal'))
                            ]
                            ,
                              [
                                'name' => 'Paid',
                                'color' => '#6aa66a',
                                   'animation'=> false,
                                'data' => array_map('intval', array_column($report->getPricipalAmount2(), 'PrincipalPaid'))
                            ],
                                [
                                'name' => 'Not Paid',
                                'color' => '#c96253',
                                     'animation'=> false,
                                'data' => array_map('intval', array_column($report->getPrincipalNotPaid(), 'PrincipalNotPaid'))
                            ]
                        ],
                        'credits' => ['enabled' => false],
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>


<?php 
Pjax::end();
?>
<pre>
    <?php
    foreach ($ledger_entries as $key) {
        # code...
        $dueDate = $key["next_date"];
        if (!empty($dueDate)) {
            # code...
            $today = time();
            $dueDateTime = strtotime($dueDate);
            $nextDate = strtotime($dueDate . "+1 Week");
            $suspendDate = strtotime($dueDate . "+60 Day");
            $payMentid = $key["id"];
            if ($today > $dueDateTime  ) {
                ///insert into DB & upDate
                $fine = 20000;
                $status=25;
                $debit=41223;
                $finePayLoad = array([
                        "description" => $key["description"] . " fine",
                        "entry_reference" => $key["entry_reference"],
                        "amount" => $fine,
                        "debit_account" => $debit,
                        "credit_account" => $key["credit_account"],
                        "entry_type" => $key["entry_type"],
                        "entry_reference_id" => $key["entry_reference_id"],
                        "schedule_id" => $key["schedule_id"],
                        "created_at" => time(),
                        "created_by" => $key["created_by"],
                        "member_account" => $key["member_account"],
                        "entry_period" => $key["entry_period"],
                        "ledger_status" => $status,
                ]);
                $updatePayLoad = array('next_date' => date("Y-m-d",$nextDate));
                Yii::$app->db->createCommand()->insert('ledger', $finePayLoad[0])->execute();
                Yii::$app->db->createCommand('UPDATE ledger SET next_date = "'. date("Y-m-d",$nextDate).'",ledger_status=90 WHERE id =' . $payMentid)->execute();
                
            }
            
             if ($today > $suspendDate) {
                ///update  DB
                Yii::$app->db->createCommand('UPDATE ledger SET ledger_status = 85,next_date=null WHERE id =' . $payMentid[0])->execute();
            }
       
        }
    }
    print_r($ledger_entries);
    ?>

</pre>
<?php 

$js = 'function refresh() {
     $.pjax.reload({container:"#cardsGrid"});
     setTimeout(refresh, 1000); // restart the function every 8 seconds
 }
 refresh();';
 $this->registerJs($js, $this::POS_READY);
?>