<?php

namespace frontend\controllers;

use Yii;
use common\models\client\Loan;
use common\models\client\LoanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\client\Client;
use common\models\client\LoanGuarantor;
use common\models\client\LoanGuarantorSearch;
use common\models\client\ClientMasterData;
use common\models\client\LoanCollateral;
use common\models\client\LoanCollateralSearch;
use common\models\client\ChartOfAccounts;
use yii\web\UploadedFile;
use common\models\client\LoanManagerRemarks;
use common\models\client\Investment;
use common\models\client\LoanManagerRemarksSearch;
use common\models\client\LoanAmortization;
use common\models\loan\LedgerTransactionConfig;
use common\models\loan\LedgerHelper;
use common\models\loan\Ledger;
use common\models\report\OverduePaymentsSearch;
use common\models\report\DueThisWeekSearh;
use common\models\report\AgingReportSearch;
use common\models\report\DueThisDateSearch;
use common\models\report\DueThisMonthSearh;
use common\models\loan\LedgerSearch;
use common\models\loan\LedgerPayment;
use common\models\loan\LedgerPaymentSearch;
use common\models\report\LoanInterestSearch;
use common\models\report\LedgerReportSearch;
use common\models\report\LoanPortifolioSearch;
use common\models\ReferenceHelper;
use common\models\loan\LoanPaymentSchedule;
use common\models\Reports;
use common\models\loan\Score;
use common\models\loan\BorrowerCheckList;
use Mpdf\Mpdf;
use yii\filters\AccessControl;

/**
 * LoanController implements the CRUD actions for Loan model.
 */
class LoanController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'index'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //   'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists of Loan Applications.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $loggedIn = Yii::$app->member;
        $searchModel = new LoanSearch();
        $searchModel->created_by = $loggedIn->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        $dataProvider->sort = ['defaultOrder' => ['created_at' => 'SORT_DESC']];
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLoanPortifolio() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $loggedIn = Yii::$app->member;
        $searchModel = new LoanPortifolioSearch();
        $searchModel->created_by = $loggedIn->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        $dataProvider->sort = ['defaultOrder' => ['created_at' => 'SORT_DESC']];
        return $this->render('loan-portifolio', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAllLoans() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LoanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        $dataProvider->sort = ['defaultOrder' => ['created_at' => 'SORT_DESC']];
        return $this->render('all-loans', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLoanInterest() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LoanInterestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('loan-interest', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLedgerReport() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LedgerReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('ledger-report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLoanAgingReport() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LedgerReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('loan-aging-report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    // Overdue Payments

    public function actionOverDuePayments() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new OverduePaymentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('over-due-payments', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    // Overdue Payments

    public function actionInterestDuePayments() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LedgerSearch();
        $searchModel->debit_account = 12210;
        $searchModel->ledger_status = 42;
        $searchModel->entry_type = "LOAN";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('interest-due-payments', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    // Paid Principal Payments

    public function actionInterestPaidPayments() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LedgerSearch();
        $searchModel->debit_account = 12210;
        $searchModel->ledger_status = 43;
        $searchModel->entry_type = "LOAN";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('interest-paid-payments', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    // Paid Principal Payments

    public function actionSuspendedInterestPayments() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LedgerSearch();
        $searchModel->debit_account = 12210;
        $searchModel->ledger_status = 85;
        $searchModel->entry_type = "LOAN";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('suspended-interest-payments', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    // Due Payments

    public function actionPrincipalDuePayments() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $model = new Ledger();
        return $this->render('principal-due-payments', [
                    'model' => $model,
        ]);
    }

    // Overdue Payments


    public function actionPrincipalPaidPayments() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $model = new Ledger();
        return $this->render('principal-paid-payments', [
                    'model' => $model,
        ]);
    }

    // Payments Due this week
    // Overdue Payments

    public function actionDueWeekPayments() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new DueThisWeekSearh();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('due-week-payments', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAgingReport() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new AgingReportSearch();
        $model = new \common\models\report\AgingReport();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('aging-report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    // Payments Due this week
    // Overdue Payments

    public function actionDueDayPayments() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new DueThisDateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('due-day-payments', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    // Paid  this week

    public function actionPaidThisWeek() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $model = new Ledger();
        return $this->render('paid-this-week', [
                    'model' => $model,
        ]);
    }

    // Payments Due this week
    // Overdue Payments

    public function actionDueMonthPayments() {
        $searchModel = new DueThisMonthSearh();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('due-week-payments', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    // Paid  this month
    public function actionPaidThisMonth() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $model = new Ledger();
        return $this->render('paid-this-month', [
                    'model' => $model,
        ]);
    }

    /**
     * Lists of All Loan Applications.
     * @return mixed
     */
    public function actionPendingLoanApplications() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $loggedIn = Yii::$app->member;
        $searchModel = new LoanSearch();
        $searchModel->created_by = $loggedIn->id;
        $searchModel->status = 87;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('pending-loan-applications', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists of All Loan Applications.
     * @return mixed
     */
    public function actionSubmittedLoanApplications() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LoanSearch();
        $searchModel->status = 87;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        $dataProvider->sort = ['defaultOrder' => ['submitted_at' => 'SORT_DESC']];
        return $this->render('submitted-loan-applications', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists of All Loan Applications.
     * @return mixed
     */
    public function actionSubmittedApplications() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LoanSearch();
        $searchModel->status = 89;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        $dataProvider->sort = ['defaultOrder' => ['created_at' => 'SORT_DESC']];
        return $this->render('submitted-applications', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists of All Loan Applications.
     * @return mixed
     */
    public function actionReturnedLoanApplications() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LoanSearch();
        $searchModel->status = 88;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        $dataProvider->sort = ['defaultOrder' => ['created_at' => 'SORT_DESC']];
        return $this->render('returned-loan-applications', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists of Approved Loan Applications.
     * @return mixed
     */
    public function actionLoanApplications($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin_loan";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager_loan";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector_loan";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer_loan";
        } else {
            $this->layout = "main";
        }
        return $this->render('loan-applications', [
                    'model' => $this->findClientModel($id),
        ]);
    }

    /**
     * Lists of Approved Loan Applications.
     * @return mixed
     */
    public function actionApprovedLoanApplications() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LoanSearch();
        $searchModel->status = 20;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        $dataProvider->sort = ['defaultOrder' => ['created_at' => 'SORT_DESC']];
        return $this->render('approved-loan-applications', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists of Disbursed Loan Applications.
     * @return mixed
     */
    public function actionDisbursedLoanApplications() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LoanSearch();
        $searchModel->status = 41;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
        return $this->render('disbursed-loan-applications', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists of Disbursed Loan Applications.
     * @return mixed
     */
    public function actionPaidLoanApplications() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LoanSearch();
        $searchModel->status = 86;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
        return $this->render('paid-loan-applications', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    // Loan Schedule

    public function actionLoanSchedule() {

        return $this->render('loan-schedule');
    }

    /**
     * Lists of Approved Loan Applications.
     * @return mixed
     */
    public function actionRejectedLoanApplications() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LoanSearch();
        $searchModel->status = 36;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        return $this->render('rejected-loan-applications', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * List of Loan Guarantors.
     * @return mixed
     */
    public function actionLoanGuarantors($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin_guarantors";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager_guarantors";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director_guarantors";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer_guarantors";
        } else {
            $this->layout = "main";
        }
        $loan = $this->findLoanModel($id);
        $searchModel = new LoanGuarantorSearch();
        $searchModel->loan_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('loan-guarantors', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'loan' => $loan,
                    'loanId' => $id,
        ]);
    }

    //Loan Payment History
    
     public function actionLoanPaymentHistory($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "payment_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "payment_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "payment_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "payment_officer";
        } else {
            $this->layout = "main";
        }
        return $this->render('loan-payment-history', [
                    'model' => $this->findModel($id),
        ]);
    }
    
         public function actionLoanPaymentPenalties($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "payment_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "payment_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "payment_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "payment_officer";
        } else {
            $this->layout = "main";
        }
        return $this->render('loan-payment-penalties', [
                    'model' => $this->findModel($id),
        ]);
    }
    /**
     * List of Loan Guarantors.
     * @return mixed
     */
    public function actionLoanApplicationFees($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $loan = $this->findLedgerModel($id);
        $searchModel = new LedgerSearch();
        $searchModel->entry_reference_id = $id;
        $searchModel->stage = "APPLICATION";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('loan-application-fees', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'loan' => $loan,
                    'loanId' => $id,
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * List of Loan Collateral Uploads.
     * @return mixed
     */
    public function actionLoanCollateral($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin_collateral";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager_collateral";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director_collateral";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer_collateral";
        } else {
            $this->layout = "main";
        }
        $loan = $this->findLoanModel($id);
        $searchModel = new LoanCollateralSearch();
        $searchModel->loan_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('loan-collateral', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'loan' => $loan,
                    'loanId' => $id,
        ]);
    }

    /**
     * List of Loan Application Rejections.
     * @return mixed
     */
    public function actionRejectionRemarks($id) {
        $loan = $this->findLoanModel($id);
        $searchModel = new LoanManagerRemarksSearch();
        $searchModel->loan_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('rejection-remarks', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'loan' => $loan,
        ]);
    }

    /**
     * List of Loan Proof of  Payments.
     * @return mixed
     */
    public function actionProofOfPayments($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin_payments";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager_payments";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director_payments";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer_payments";
        } else {
            $this->layout = "main";
        }
        $loan = $this->findLoanModel($id);
        $searchModel = new LedgerPaymentSearch();
        $searchModel->loan_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('proof-of-payments', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'loan' => $loan,
                    'loanId' => $id,
        ]);
    }

    /**
     * List of Loan Proof of  Payments.
     * @return mixed
     */
    public function actionPaymentsReceipts($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $loan = $this->findLoanScheduleModel($id);
        $searchModel = new LedgerPaymentSearch();
        $searchModel->schedule_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('payments-receipts', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'loan' => $loan,
                    'scheduleId' => $id,
        ]);
    }

    /**
     * Payment `Summarry Report.
     * @return mixed
     */
    public function actionPaymentSummarryReport() {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $searchModel = new LedgerPaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('payment-summarry-report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Loan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        return $this->render('view', [
                    'balance' => ReferenceHelper::getTotalPrincipalPaid($id),
                    'ledger_entries' => Reports::getLedgerEntries(),
                    'model' => $model,
        ]);
    }

    public function actionViewLoanProfile($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin_logs";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        return $this->render('view-loan-profile', [
                    'balance' => ReferenceHelper::getTotalPrincipalPaid($id),
                    'ledger_entries' => Reports::getLedgerEntries(),
                    'model' => $model,
        ]);
    }

    public function actionViewRatingPlate($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        return $this->render('view-rating-plate', [
                    'balance' => ReferenceHelper::getTotalPrincipalPaid($id),
                    'ledger_entries' => Reports::getLedgerEntries(),
                    'model' => $model,
        ]);
    }

    public function actionViewRequirementsPlate($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        return $this->render('view-requirements-plate', [
                    'balance' => ReferenceHelper::getTotalPrincipalPaid($id),
                    'ledger_entries' => Reports::getLedgerEntries(),
                    'model' => $model,
        ]);
    }

    public function actionViewPayments($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "schedule_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "schedule_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "schedule_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "schedule_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findLoanScheduleModel($id);
        return $this->render('view-payments', [
                    'balance' => ReferenceHelper::getTotalPrincipalPaid($id),
                    'ledger_entries' => Reports::getLedgerEntries(),
                    'model' => $model,
        ]);
    }

    /**
     * Displays a payment history for the loan
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPaymentHistory($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        return $this->render('payment-history', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a payment history for the loan
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionInvestmentPaymentHistory($id) {
        $this->layout = "investmentprofile";
        return $this->render('investment-payment-history', [
                    'model' => $this->findInvestmentModel($id),
        ]);
    }
    
    
        public function actionMakePenaltyPayment($id, $ledger,$type="LOAN") {
           if (Yii::$app->member->office_id === 1) {
            $this->layout = "schedule_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "schedule_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "schedule_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "schedule_officer";
        } else {
            $this->layout = "main";
        }
        $payledgers = explode(",", $ledger);
        $payment = new LedgerPayment();
        $ledgers = Ledger::find()->where(['id' => $payledgers])->all();

        //If we have managed to load and save the payment...
        if ($payment->load(Yii::$app->request->post())) {
            $payment->reference_no = ReferenceHelper::getPaymentReferenceNumber();
            //Advance payment=Amount Paid-Amount Expected
            $payment->advance_payment = ($payment->amount_paid - $payment->bill_total);
            //Save Payment
            $payment->save(false);
            //Save Ledger records for this payment...
//            $ledgerPayments = LedgerHelper::setLedgerPayment($payment, $ledgers);
//            foreach ($ledgerPayments AS $lg) {
//                $lg->save(false);
//            }
            //Update Payment status
            Ledger::updateAll(['ledger_status' => Ledger::STATUS_PAID], ['id' => $payledgers]);
            //Upload Proof of Paymnent
            $timenow = uniqid();
            $payment->proof_attachment = UploadedFile::getInstance($payment, 'proof_attachment');

            if (!empty($payment->proof_attachment)) {
                $dir = Yii::getAlias('@dir_htmlassets') . '/payments';
                //Try to save
                //$model->proof_of_ownership->saveAs($dir . "/" . $filename);
                $payment->proof_attachment->saveAs($dir . "/" . $timenow . '.' . $payment->proof_attachment->extension);

                //save the path in the db

                $payment->proof_attachment = $timenow . '.' . $payment->proof_attachment->extension;
                //$payment->proof_attachment = $filename;
            }

            //$payment->proof_attachment = null;
            $payment->save(false);
            //Go back to payment history
            //Go back to payment history
            return $this->redirect(['view', 'id' => $id]);
        } else {
            $pay_accounts = ChartOfAccounts::find()
                    ->where(['gl_code' => '11300'])
                    ->all();
            $payment_methods = ClientMasterData::find()
                    ->where(['reference_table' => 'payment_method'])
                    ->all();
            $payment->loan_id = $id;
            $payment->transaction_type = $type;
              $payment->debit_account = 41110;
            return $this->render('make-penalty-payment',
                            [
                                'model' => $this->findModel($id),
                                'ledgers' => $ledgers,
                                'pay_ledgers' => $ledger,
                                'payment' => $payment,
                                'total' => array_sum(array_column($ledgers, 'amount')),
                                'pay_accounts' => $pay_accounts,
                                'payment_methods' => $payment_methods
                            ]
            );
        }
    }

    /**
     * Make payment
     */
    public function actionPay($id, $ln, $type = "LOAN") {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "schedule_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "schedule_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "schedule_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "schedule_officer";
        } else {
            $this->layout = "main";
        }
        $payment = new LedgerPayment();
        $model = $this->findLoanScheduleModel($id);
        $loan = $this->findLoanModel($ln);
        $ledgerEntries = [];
        $ledgerHelper = new LedgerHelper(['loan_id' => $id]);
        //If we have managed to load and save the payment...
        if ($payment->load(Yii::$app->request->post())) {
            $interest = $model->loanScheduleEntries[1]['amount'];
            $principal = $model->loanScheduleEntries[0]['amount'];
            $paidinterest = $model->interest_paid;
            $paidprincipal = $model->principal_paid;
            $paid = $payment->amount_paid;
            $balance = $paid - $interest;
            $principalbalance = $principal - $paidprincipal;
            $interestbalance = $interest - $paidinterest;

            if ($paidinterest < $interest) {

                if ($balance > 0) {
                    //$ledgerPayments = LedgerHelper::setLedgerPayments($interest, 1);
                    $ledgerPayments = $ledgerHelper->setLedgerPayments($interest, 1);
                    foreach ($ledgerPayments AS $lg) {
                        $lg->save(false);
                    }
                    Ledger::updateAll(['ledger_status' => Ledger::STATUS_PAID, 'next_date' => null], ['id' => $model->loanScheduleEntries[1]['id']]);
                    LoanPaymentSchedule::updateAll(['interest_paid' => $interest], ['id' => $id]);

                    $result = $balance - $principal;
                    if ($result >= 0) {
                        //$ledgerPayments = LedgerHelper::setLedgerPayments($principal, 0);
                        $ledgerPayments = $ledgerHelper->setLedgerPayments($principal, 0);
                        foreach ($ledgerPayments AS $lg) {
                            $lg->save(false);
                        }
                        Ledger::updateAll(['ledger_status' => Ledger::STATUS_PAID, 'next_date' => null], ['id' => $model->loanScheduleEntries[0]['id']]);
                        LoanPaymentSchedule::updateAll(['principal_paid' => $principal], ['id' => $id]);
                    } else {
                        $ledgerPayments = $ledgerHelper->setLedgerPayments($balance, 0);
                        foreach ($ledgerPayments AS $lg) {
                            $lg->save(false);
                        }
                        LoanPaymentSchedule::updateAll(['principal_paid' => $balance], ['id' => $id]);
                    }
                } else {
                    $ledgerPayments = $ledgerHelper->setLedgerPayments($paid, 1);
                    foreach ($ledgerPayments AS $lg) {
                        $lg->save(false);
                    }
                    Yii::$app->db->createCommand('UPDATE loan_payment_schedule SET interest_paid = interest_paid + "' . $paid . '"  WHERE id =' . $id)->execute();

                    $newPaidinterest = Yii::$app->db->createCommand('SELECT interest_paid from loan_payment_schedule  WHERE id =' . $id)->queryOne();
                    if ($newPaidinterest["interest_paid"] >= $interest) {
                        Ledger::updateAll(['ledger_status' => Ledger::STATUS_PAID], ['id' => $model->loanScheduleEntries[1]['id']]);
                    }
                }
            } else {
                Ledger::updateAll(['ledger_status' => Ledger::STATUS_PAID], ['id' => $model->loanScheduleEntries[1]['id']]);
                $result = $paid - $principal;
                if ($result >= 0) {
                    $ledgerPayments = $ledgerHelper->setLedgerPayments($principal, 0);
                    foreach ($ledgerPayments AS $lg) {
                        $lg->save(false);
                    }
                    Ledger::updateAll(['ledger_status' => Ledger::STATUS_PAID], ['id' => $model->loanScheduleEntries[0]['id']]);
                    LoanPaymentSchedule::updateAll(['principal_paid' => $principal], ['id' => $id]);
                } else {
                    $ledgerPayments = $ledgerHelper->setLedgerPayments($paid, 0);
                    foreach ($ledgerPayments AS $lg) {
                        $lg->save(false);
                    }

                    Yii::$app->db->createCommand('UPDATE loan_payment_schedule SET principal_paid = principal_paid + "' . $paid . '"  WHERE id =' . $id)->execute();

                    $newPaidPrincipal = Yii::$app->db->createCommand('SELECT principal_paid from loan_payment_schedule  WHERE id =' . $id)->queryOne();
                    if ($newPaidPrincipal["principal_paid"] >= $principal) {
                        Ledger::updateAll(['ledger_status' => Ledger::STATUS_PAID], ['id' => $model->loanScheduleEntries[0]['id']]);
                    }
                }
            }


            if ($principalbalance + $interestbalance <= 0) {
                //full paid
                $status = Ledger::STATUS_FULLYPAID;
                //full paid
            } else {
                $status = Ledger::STATUS_DISBURSED; ///partially paid
            }
            Loan::updateAll(['status' => $status], ['id' => $id]);


            $payment->reference_no = ReferenceHelper::getPaymentReferenceNumber();
            //Advance payment=Amount Paid-Amount Expected
//            $payment->balance = ($paid - $interest);
            //Save Payment
            $payment->save(false);
            //Save Ledger records for this payment...
//            $ledgerPayments = LedgerHelper::setLedgerPayment($payment, $id);
//            foreach ($ledgerPayments AS $lg) {
//                $lg->save(false);
//            }
            //Upload Proof of Paymnent
            $timenow = uniqid();
            $payment->proof_attachment = UploadedFile::getInstance($payment, 'proof_attachment');

            if (!empty($payment->proof_attachment)) {
                $dir = Yii::getAlias('@dir_htmlassets') . '/payments';
                //Try to save
                //$model->proof_of_ownership->saveAs($dir . "/" . $filename);
                $payment->proof_attachment->saveAs($dir . "/" . $timenow . '.' . $payment->proof_attachment->extension);

                //save the path in the db

                $payment->proof_attachment = $timenow . '.' . $payment->proof_attachment->extension;
                //$payment->proof_attachment = $filename;
            }

            //$payment->proof_attachment = null;
            $payment->save(false);
            //Go back to payment history
            //Go back to payment history
            return $this->redirect(['view-payments', 'id' => $id]);
        } else {
            $pay_accounts = ChartOfAccounts::find()
                    ->where(['gl_code' => '11300'])
                    ->all();
            $payment_methods = ClientMasterData::find()
                    ->where(['reference_table' => 'payment_method'])
                    ->all();
            $payment->loan_id = $model->loan->id;
            $payment->schedule_id = $id;
            $payment->debit_account = 41110;
            $payment->transaction_type = $type;
            return $this->render('pay',
                            [
                                'model' => $model,
                                'loan' => $loan,
                                'payment' => $payment,
                                'pay_accounts' => $pay_accounts,
                                'payment_methods' => $payment_methods
                            ]
            );
        }
    }

//Make Block Payments on the Loan Schedule
    public function actionMakeLoanPayment($id, $type = "LOAN") {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "schedule_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "schedule_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "schedule_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "schedule_officer";
        } else {
            $this->layout = "main";
        }
        $payment = new LedgerPayment();
        $model = $this->findLoanModel($id);
        $ledgerEntries = [];
        $ledgerHelper = new LedgerHelper(['loan_id' => $id]);
        //If we have managed to load and save the payment...
        $schedule = Yii::$app->db->createCommand("SELECT *  FROM loan_payment_schedule  WHERE loan_id =$id AND status=42 OR status= 91")->queryAll();
        if ($payment->load(Yii::$app->request->post())) {
            $prin = $payment->amount_paid;
            $arr = [];
            if ($prin > 0) {
                for ($i = 0; $i < count($schedule); $i++) {
                    # code...
                    $initialAmount = $prin;
                    print_r("\n\nValidate Payment installation No. " . ($i + 1) . "\n");
                    $interest = $schedule[$i]["interest_amount"];
                    $principal = $schedule[$i]["principal_amount"];
                    $credit=41110;
                    $debit=12210;
                    $creditPrincipal=11300;
                    $debitPrincipal=11110;
                    $principalPaid = $schedule[$i]["principal_paid"];
                    $interestPaid = $schedule[$i]["interest_paid"];
                    $interest > $interestPaid ? ($prin = $prin - ($interest - $interestPaid)) : $prin;
                    $interestToPay = $interest - $interestPaid;
                    $principalToPay = $principal - $principalPaid;
                    $itemId = $schedule[$i]["id"];
                    if ($prin > 0 && $interestPaid < $interest) {
                        ///only pay whats due
                        print_r("Cleared interest of " . number_format($interestToPay) . " for this payment id " . ($i + 1) . " and update the database with interest paid of : " . number_format($interest) . "\n");
                        LoanPaymentSchedule::updateAll(['interest_paid' => $interest], ['id' => $itemId]);
                        Yii::$app->db->createCommand()->insert('transaction_payments', [
                            'loan_id' => $model->id,
                            'amount' => $interest,
                            'credit_account' => $credit,
                            'debit_account' => $debit,
                            'description' => 'Interest',
                            'created_at' =>time(),
                            'created_by' => Yii::$app->member->id,
                        ])->execute();
                        print_r("Balance to be moved to principal is :" . number_format($prin) . "\n");
                        array_push($arr, $interestToPay);
                        //save fully the initial interest
                        ///clear this interest fully and move to principal
                        //subtract the principal from the remaining amount
                        $principal > $principalPaid ? ($prin = $prin - ($principal - $principalPaid)) : $prin;
                        if ($prin >= 0 && $principalPaid < $principal) {
                            //if the remainder after removing interest is greater than 0
                            print_r("Cleared principal of " . number_format($principalToPay) . " for this payment id " . ($i + 1) . " and update the database with principal paid of : " . number_format($principal) . "\n");
                            LoanPaymentSchedule::updateAll(['principal_paid' => $principal], ['id' => $itemId]);
                    Yii::$app->db->createCommand()->insert('transaction_payments', [
                            'loan_id' => $model->id,
                            'amount' => $principal,
                            'credit_account' => $creditPrincipal,
                            'debit_account' => $debitPrincipal,
                            'description' => 'Principal',
                            'created_at' =>time(),
                            'created_by' => Yii::$app->member->id,
                        ])->execute();
                            print_r("Balance to be moved forward is :" . number_format($prin));
                            array_push($arr, $principalToPay);
                        } else if ($initialAmount > 0 && $principalPaid < $principal) {
                            ////do a partial payment
                            print_r("Partially clear this loan principal balance of " . number_format($principalToPay) . " for id No. " . ($i + 1) . " and update principal paid to " . number_format($principal + $prin) . "\n");
                            LoanPaymentSchedule::updateAll(['principal_paid' => ($principal + $prin)], ['id' => $itemId]);
             
                            print_r("You have no balance left to c arry forward. " . "\n");
                            //save $initialAmount + $interestPaid;
                            array_push($arr, $principal + $prin);
                        }
                    } else if ($initialAmount > 0 && $interestPaid < $interest) {
                        print_r("Partially clear this loan interest balance of " . number_format($interestToPay) . " for id No. " . ($i + 1) . " and update interest paid to " . number_format($initialAmount + $interestPaid) . "\n");
                        LoanPaymentSchedule::updateAll(['interest_paid' => ($initialAmount + $interestPaid)], ['id' => $itemId]);
                          Yii::$app->db->createCommand()->insert('transaction_payments', [
                            'loan_id' => $model->id,
                            'amount' => $initialAmount,
                            'credit_account' => $credit,
                            'debit_account' => $debit,
                            'description' => 'Interest',
                            'created_at' =>time(),
                            'created_by' => Yii::$app->member->id,
                        ])->execute();
                        print_r("You have no balance left. " . "\n");
                        //save $initialAmount + $interestPaid;
                        array_push($arr, $initialAmount);
                    } else if ($interestPaid >= $interest && $principalPaid < $principal) {
                        //handle only principal here
                        print_r("This interest for installation id : " . number_format($i + 1) . " of " . number_format($interest) . "has been cleared\n");
                        print_r("The amont to be appled on pricipal is :" . number_format($prin) . "\n");
                        ////start principal
                        $principal > $principalPaid ? ($prin = $prin - ($principal - $principalPaid)) : $prin;
                        if ($prin >= 0 && $principalPaid < $principal) {
                            //if the remainder after removing interest is greater than 0
                            print_r("Cleared principal of " . number_format($principalToPay) . " for this payment id " . ($i + 1) . " and update the database with principal paid of : " . number_format($principal) . "\n");
                            LoanPaymentSchedule::updateAll(['principal_paid' => $principal], ['id' => $itemId]);
                     
                            print_r("Balance to be moved forward is :" . number_format($prin));
                            array_push($arr, $principalToPay);
                        } else if ($initialAmount > 0 && $principalPaid < $principal) {
                            ////do a partial ppayment
                            print_r("Partially clear this loan principal balance of " . number_format($principalToPay) . " for id No. " . ($i + 1) . " and update principal paid to " . number_format($initialAmount + $principalPaid) . "\n");
                            LoanPaymentSchedule::updateAll(['principal_paid' => ($initialAmount + $principalPaid)], ['id' => $itemId]);
                         Yii::$app->db->createCommand()->insert('transaction_payments', [
                            'loan_id' => $model->id,
                            'amount' => $initialAmount,
                            'credit_account' => $creditPrincipal,
                            'debit_account' => $debitPrincipal,
                             'description' => 'Principal',
                            'created_at' =>time(),
                            'created_by' => Yii::$app->member->id,
                        ])->execute();
                            print_r("You have no balance left to c arry forward. " . "\n");
                            //save $initialAmount + $interestPaid;
                            array_push($arr, $initialAmount);
                        }
                    }
                }
                if ($prin > 0) {
                    print_r("\n\nPocket change :" . number_format($prin));
                }
                print_r("\n\nWe have played with an amount of " . number_format(array_sum($arr)));
            }

            $payment->reference_no = ReferenceHelper::getPaymentReferenceNumber();
            //Advance payment=Amount Paid-Amount Expected
            $payment->advance_payment = ($payment->amount_paid - $payment->bill_total);
            //Save Payment
            $payment->save(false);
            //Save Ledger records for this payment...
//            $ledgerPayments = LedgerHelper::setLedgerPayment($payment, $ledgers);
//            foreach ($ledgerPayments AS $lg) {
//                $lg->save(false);
//            }
            //Update Payment status
            // Ledger::updateAll(['ledger_status' => Ledger::STATUS_PAID, 'interest_status' => Ledger::STATUS_PAID], ['id' => $payledgers]);
            //Upload Proof of Paymnent
            $timenow = uniqid();
            $payment->proof_attachment = UploadedFile::getInstance($payment, 'proof_attachment');

            if (!empty($payment->proof_attachment)) {
                $dir = Yii::getAlias('@dir_htmlassets') . '/payments';
                //Try to save
                //$model->proof_of_ownership->saveAs($dir . "/" . $filename);
                $payment->proof_attachment->saveAs($dir . "/" . $timenow . '.' . $payment->proof_attachment->extension);

                //save the path in the db

                $payment->proof_attachment = $timenow . '.' . $payment->proof_attachment->extension;
                //$payment->proof_attachment = $filename;
            }

            //$payment->proof_attachment = null;
            $payment->save(false);
            //Go back to payment history
            //Go back to payment history
            return $this->redirect(['view', 'id' => $id]);
        } else {
            $pay_accounts = ChartOfAccounts::find()
                    ->where(['gl_code' => '11300'])
                    ->all();
            $payment_methods = ClientMasterData::find()
                    ->where(['reference_table' => 'payment_method'])
                    ->all();
            $payment->loan_id = $model->id;
            $payment->schedule_id = $id;
            $payment->debit_account = 41110;
            $payment->transaction_type = $type;
            return $this->render('make-loan-payment',
                            [
                                'model' => $model,
                                'payment' => $payment,
                                'schedule' => $schedule,
                                'pay_accounts' => $pay_accounts,
                                'payment_methods' => $payment_methods
                            ]
            );
        }
    }

    //Reject Loan Application Loan
    public function actionRejectLoanApplication($id, $cat = 'LOAN', $stat = 3) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = new LoanManagerRemarks();
        $loan = $this->findLoanModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->db->createCommand('UPDATE loan SET status = 36 WHERE id =' . $id)->execute();
            //Go back tolist of clients
            Yii::$app->session->setFlash('success', 'You have successfully rejected Loan Application');

            return $this->redirect(['view', 'id' => $loan->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_id = $id;
            $model->client_id = $loan->client->id;
            $model->category = $cat;
            $model->remarks_status = $stat;
            return $this->render('reject-loan-application', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
            ]);
        }
    }

    /**
     * Approve Payments
     */
    public function actionApprovePayments($id, $sch, $type = "PAYMENT", $cat = 'LOAN', $stat = 3) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "ledger_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "ledger_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "ledger_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "ledger_officer";
        } else {
            $this->layout = "main";
        }
        $payment = new LoanManagerRemarks();
        $loan = $this->findLedgerModel($id);
        $schedule = $this->findLoanScheduleModel($sch);

        //If we have managed to load and save the payment...
        if ($payment->load(Yii::$app->request->post())) {
            //Save Payment
            $payment->save(false);
            //Update Payment status
            Ledger::updateAll(['ledger_status' => Ledger::STATUS_APPROVED], ['id' => $id]);

            return $this->redirect(['view-payments', 'id' => $schedule->id]);
        } else {

            $payment->created_at = time();
            $payment->created_by = Yii::$app->member->id;
            $payment->loan_id = $loan->loanLedger->id;
            $payment->client_id = $loan->loanLedger->client->id;
            $payment->category = $cat;
            $payment->remarks_status = $stat;
            return $this->render('approve-payments',
                            [
                                'payment' => $payment,
                                'loan' => $loan,
                                'schedule' => $schedule,
                                'ledgerId' => $id,
                            ]
            );
        }
    }

    /**
     * Reject Payments
     */
    public function actionRejectPayments($id, $sch, $type = "PAYMENT", $cat = 'LOAN', $stat = 3) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "ledger_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "ledger_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "ledger_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "ledger_officer";
        } else {
            $this->layout = "main";
        }
        $payment = new LoanManagerRemarks();
        $loan = $this->findLedgerModel($id);
        $schedule = $this->findLoanScheduleModel($sch);

        //If we have managed to load and save the payment...
        if ($payment->load(Yii::$app->request->post())) {
            //Save Payment
            $payment->save(false);
            //Update Payment status
            Ledger::updateAll(['ledger_status' => Ledger::STATUS_REJECTED], ['id' => $id]);

            return $this->redirect(['view-payments', 'id' => $schedule->id]);
        } else {

            $payment->created_at = time();
            $payment->created_by = Yii::$app->member->id;
            $payment->loan_id = $loan->loanLedger->id;
            $payment->client_id = $loan->loanLedger->client->id;
            $payment->category = $cat;
            $payment->remarks_status = $stat;
            return $this->render('reject-payments',
                            [
                                'payment' => $payment,
                                'loan' => $loan,
                                'schedule' => $schedule,
                                'ledgerId' => $id,
                            ]
            );
        }
    }

    /**
     * Make payment
     */
    public function actionPayment($id, $ln, $type = "LOAN") {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "ledger_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "ledger_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "ledger_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "ledger_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findLedgerModel($id);
        $loan = $this->findLoanModel($ln);
        $payment = new LedgerPayment();

        //If we have managed to load and save the payment...
        if ($payment->load(Yii::$app->request->post())) {
            $payment->reference_no = ReferenceHelper::getPaymentReferenceNumber();
            //Advance payment=Amount Paid-Amount Expected
            $payment->advance_payment = ($payment->amount_paid - $payment->bill_total);
            //Save Payment
            $payment->save(false);
            //Save Ledger records for this payment...
            $ledgerPayments = LedgerHelper::setLedgerPayment($payment, $ledgers);
            foreach ($ledgerPayments AS $lg) {
                $lg->save(false);
            }
            //Update Payment status
            Ledger::updateAll(['ledger_status' => Ledger::STATUS_PAID, 'interest_status' => Ledger::STATUS_PAID], ['id' => $id]);
            //Upload Proof of Paymnent
            $timenow = uniqid();
            $payment->proof_attachment = UploadedFile::getInstance($payment, 'proof_attachment');

            if (!empty($payment->proof_attachment)) {
                $dir = Yii::getAlias('@dir_htmlassets') . '/payments';
                //Try to save
                //$model->proof_of_ownership->saveAs($dir . "/" . $filename);
                $payment->proof_attachment->saveAs($dir . "/" . $timenow . '.' . $payment->proof_attachment->extension);

                //save the path in the db

                $payment->proof_attachment = $timenow . '.' . $payment->proof_attachment->extension;
                //$payment->proof_attachment = $filename;
            }

            //$payment->proof_attachment = null;
            $payment->save(false);
            //Go back to payment history
            //Go back to payment history
            return $this->redirect(['loan/due-week-payments']);
        } else {
            $pay_accounts = ChartOfAccounts::find()
                    ->where(['gl_code' => '11300'])
                    ->all();
            $payment_methods = ClientMasterData::find()
                    ->where(['reference_table' => 'payment_method'])
                    ->all();
            $payment->loan_id = $id;
            $payment->transaction_type = $type;
            return $this->render('payment',
                            [
                                'model' => $model,
                                'ledgerId' => $id,
                                'payment' => $payment,
                                'pay_accounts' => $pay_accounts,
                                'payment_methods' => $payment_methods
                            ]
            );
        }
    }

    /**
     * Merge Loan
     */
    public function actionMerge($id, $ledger, $stat = 19, $lntype = 1, $currency = 35, $amortization = 40) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofile";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }

        $payledgers = explode(",", $ledger);
        $model = new Loan();
        $ledgers = Loan::find()->where(['id' => $payledgers])->all();
        $client = $this->findClientModel($id);
        //$loan = $this->findLoanModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Loan::updateAll(['status' => Loan::STATUS_MERGED], ['id' => $payledgers]);
            //Yii::$app->db->createCommand('UPDATE loan SET status = 73 Where id IN implode("','",$payledgers)')->execute();
            return $this->redirect(['pending-loan-applications']);
        } else {
            $type = ClientMasterData::findAll(['reference_table' => 'loan_type']);
            $model->created_at = time();
            $model->client_id = $id;
            $model->created_by = Yii::$app->member->id;
            $model->reference_number = ReferenceHelper::getLoanReferenceNumber();
            $model->amount_applied_for = ReferenceHelper::getTotalBalance($ledger)["principal_paid"];
            $model->status = $stat;
            $model->loan_type = $lntype;
            $model->currency = $currency;
            $model->amortization_method = $amortization;
            return $this->render('merge', [
                        'model' => $model,
                        'loanId' => $id,
                        'type' => $type,
                        'client' => $client,
                        'clientId' => $id,
                        'ledgers' => $ledgers,
                        'balance' => array_sum(array_column($ledgers, 'amount_approved')),
            ]);
            //078880
        }
    }

    /**
     * Make payment
     */
    public function actionMakePayment($id, $ledger, $type = "INVESTMENT") {
        $this->layout = "investmentprofile";
        $payledgers = explode(",", $ledger);
        $payment = new LedgerPayment();
        $ledgers = Ledger::find()->where(['id' => $payledgers])->all();

        //If we have managed to load and save the payment...
        if ($payment->load(Yii::$app->request->post())) {
            $payment->reference_no = ReferenceHelper::getPaymentReferenceNumber();
            //Advance payment=Amount Paid-Amount Expected
            $payment->advance_payment = ($payment->amount_paid - $payment->bill_total);
            //Save Payment
            $payment->save(false);
            //Save Ledger records for this payment...
//            $ledgerPayments = LedgerHelper::setLedgerPayment($payment, $ledgers);
//            foreach ($ledgerPayments AS $lg) {
//                $lg->save(false);
//            }
            //Update Payment status
            Ledger::updateAll(['ledger_status' => Ledger::STATUS_PAID, 'interest_status' => Ledger::STATUS_PAID], ['id' => $payledgers]);
            //Upload Proof of Paymnent
            $timenow = uniqid();
            $payment->proof_attachment = UploadedFile::getInstance($payment, 'proof_attachment');

            if (!empty($payment->proof_attachment)) {
                $dir = Yii::getAlias('@dir_htmlassets') . '/payments';
                //Try to save
                //$model->proof_of_ownership->saveAs($dir . "/" . $filename);
                $payment->proof_attachment->saveAs($dir . "/" . $timenow . '.' . $payment->proof_attachment->extension);

                //save the path in the db

                $payment->proof_attachment = $timenow . '.' . $payment->proof_attachment->extension;
                //$payment->proof_attachment = $filename;
            }

            //$payment->proof_attachment = null;
            $payment->save(false);
            //Go back to payment history
            //Go back to payment history
            return $this->redirect(['investment-payment-history', 'id' => $id]);
        } else {
            $pay_accounts = ChartOfAccounts::find()
                    ->where(['gl_code' => '11300'])
                    ->all();
            $payment_methods = ClientMasterData::find()
                    ->where(['reference_table' => 'payment_method'])
                    ->all();
            $payment->loan_id = $id;
            $payment->transaction_type = $type;
            return $this->render('make-payment',
                            [
                                'model' => $this->findModel($id),
                                'ledgers' => $ledgers,
                                'pay_ledgers' => $ledger,
                                'payment' => $payment,
                                'schedule' => $schedule,
                                'total' => array_sum(array_column($ledgers, 'amount')),
                                'pay_accounts' => $pay_accounts,
                                'payment_methods' => $payment_methods
                            ]
            );
        }
    }

    /**
     * New Loan Application
     */
    public function actionNewLoanApplication($id, $stat = 19, $stage = 'application', $lntype = 1, $currency = 35, $amortization = 40) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofile";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
        $model = new Loan();
        $client = $this->findClientModel($id);
        //$loan = $this->findLoanModel($id);
        $ledgerHelper = new LedgerHelper(['tag' => $stage, 'loan_id' => $id]);
        $ledgerEntries = [];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['add-loan-guarantor', 'id' => $model->id]);
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $type = ClientMasterData::findAll(['reference_table' => 'loan_type']);
            $model->created_at = time();
            $model->client_id = $id;
            $model->created_by = Yii::$app->member->id;
            $model->reference_number = ReferenceHelper::getLoanReferenceNumber();
            $model->status = $stat;
            $model->loan_type = $lntype;
            $model->currency = $currency;
            $model->amortization_method = $amortization;
            return $this->render('new-loan-application', [
                        'model' => $model,
                        'client' => $client,
                        //'loan' => $loan,
                        'clientId' => $id,
                        'type' => $type,
            ]);
        }
    }

    /**
     * Merge Loan
     */
    public function actionMergeLoan($id, $stat = 19, $lntype = 1, $currency = 35, $amortization = 40) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = new Loan();
        $loan = $this->findLoanModel($id);
        //$loan = $this->findLoanModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->db->createCommand('UPDATE loan SET status = 73 WHERE id =' . $id)->execute();
            return $this->redirect(['pending-loan-applications']);
        } else {
            $type = ClientMasterData::findAll(['reference_table' => 'loan_type']);
            $model->created_at = time();
            $model->client_id = $loan->client->id;
            $model->created_by = Yii::$app->member->id;
            $model->reference_number = ReferenceHelper::getLoanReferenceNumber();
            $model->balance = (ReferenceHelper::getTotalPrincipalPaid($id)["principal_paid"]);
            $model->status = $stat;
            $model->loan_type = $lntype;
            $model->currency = $currency;
            $model->amortization_method = $amortization;
            return $this->render('merge-loan', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
                        'type' => $type,
            ]);
        }
    }

    public function actionAddLoanGuarantor($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = new LoanGuarantor();
        $loan = $this->findLoanModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['add-loan-collateral', 'id' => $loan->id]);
        } else {
            $ident = ClientMasterData::findAll(['reference_table' => 'identification_type']);
            $sex = ClientMasterData::findAll(['reference_table' => 'sex']);
            $model->created_at = time();
            $model->loan_id = $id;
            $model->created_by = Yii::$app->member->id;
            return $this->render('add-loan-guarantor', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
                        'ident' => $ident,
                        'sex' => $sex,
            ]);
        }
    }

    public function actionAddLoanCollateral($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = new LoanCollateral();
        $loan = $this->findLoanModel($id);
        if (Yii::$app->request->isPost) {
            //Upload Loan Collateral
            $timenow = uniqid();
            $model->proof_of_ownership = UploadedFile::getInstance($model, 'proof_attachment');

            if (!empty($model->proof_of_ownership)) {
                $dir = Yii::getAlias('@dir_htmlassets') . '/collateral';
                //Try to save
                //$model->proof_of_ownership->saveAs($dir . "/" . $filename);
                $model->proof_of_ownership->saveAs($dir . "/" . $timenow . '.' . $model->proof_of_ownership->extension);

                //save the path in the db

                $model->proof_of_ownership = $timenow . '.' . $model->proof_of_ownership->extension;
                //$payment->proof_attachment = $filename;
            }
            $model->save(false);
            return $this->redirect(['add-application-fees', 'id' => $loan->id]);
        } else {
            $type = ClientMasterData::findAll(['reference_table' => 'type_of_collateral', 'client_type' => 'all']);
            $price = ClientMasterData::findAll(['reference_table' => 'price']);
            $type2 = ClientMasterData::findAll(['reference_table' => 'type_of_collateral', 'client_type' => 'cs']);
            $ownership = ClientMasterData::findAll(['reference_table' => 'type_of_ownership']);
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_id = $id;
            return $this->render('add-loan-collateral', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
                        'type' => $type,
                        'price' => $price,
                        'type2' => $type2,
                        'ownership' => $ownership,
            ]);
        }
    }

    public function actionAddApplicationFees($id, $stage = 'application') {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = new LedgerPayment();
        $loan = $this->findLoanModel($id);
        $ledgerHelper = new LedgerHelper(['tag' => $stage, 'loan_id' => $id]);
        $ledgerEntries = [];
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->db->createCommand('UPDATE loan SET application_payment_status = 42 WHERE id =' . $id)->execute();
            //Upload Loan Collateral
            $timenow = uniqid();
            $model->proof_attachment = UploadedFile::getInstance($model, 'proof_attachment');

            if (!empty($model->proof_attachment)) {
                $dir = Yii::getAlias('@dir_htmlassets') . '/applications';
                //Try to save
                //$model->proof_of_ownership->saveAs($dir . "/" . $filename);
                $model->proof_attachment->saveAs($dir . "/" . $timenow . '.' . $model->proof_attachment->extension);

                //save the path in the db

                $model->proof_attachment = $timenow . '.' . $model->proof_attachment->extension;
                //$payment->proof_attachment = $filename;
            }

            //Are we generating the payment schedule?
            if ($stage == 'application') {
                $ledgerEntries = $ledgerHelper->prepareLoanApplicationLedgerEntry();
            }
            //Save to the database
            //Save to the DB
            foreach ($ledgerEntries AS $ent) {
                $ent->save(false);
            }

            //Save Ledger records for this payment...
            if ($stage == 'application') {
                $ledgerEntries = $ledgerHelper->prepareRatedItem();
            }

            //Save to the database
            //Save to the DB
            foreach ($ledgerEntries AS $ent) {
                $ent->save(false);
            }

            //Save Ledger records for this payment...
            if ($stage == 'application') {
                $ledgerEntries = $ledgerHelper->prepareBorrowerRequirements();
            }

            //Save to the database
            //Save to the DB
            foreach ($ledgerEntries AS $ent) {
                $ent->save(false);
            }
            $model->save(false);
            return $this->redirect(['submit-loan-application', 'id' => $loan->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_id = $id;
            $model->transaction_type = "Application fees";
            $model->debit_account = 41210;
            $model->reference_no = ReferenceHelper::getPaymentReferenceNumber();
            $payment_methods = ClientMasterData::find()
                    ->where(['reference_table' => 'payment_method'])
                    ->all();
            return $this->render('add-application-fees', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
                        'payment_methods' => $payment_methods
            ]);
        }
    }

    /**
      Approve Loan Application
     */
    public function actionApproveLoanApplication($id, $stat = 20, $stage = 'application') {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        if (Yii::$app->request->isAjax && $model->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $method = ClientMasterData::findAll(['reference_table' => 'amortization_method']);
            $model->status = $stat;
            $model->approved_at = time();
            $model->approved_by = Yii::$app->member->id;
            return $this->render('approve-loan-application', [
                        'model' => $model,
                        'loanId' => $id,
                        'method' => $method,
            ]);
        }
    }

    /**
     *  Loan Disbursement
     */
    public function actionDisburseLoan($id, $cat = 'LOAN', $stat = 4, $stage = 'approved', $final = 'disbursement') {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        //$model = new LoanManagerRemarks();
        $model = $this->findModel($id);
        $ledgerHelper = new LedgerHelper(['tag' => $stage, 'loan_id' => $id]);
        $ledgerEntries = [];
        $ledgerDisbursementEntries = [];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->db->createCommand('UPDATE loan SET status = 41,disbursment_date=CURDATE()  WHERE id =' . $id)->execute();
            Yii::$app->session->setFlash('success', 'You have successfully disbursed Loan');
            //Are we generating the payment schedule?
            if ($stage == 'approved' && $final == 'disbursement') {
                $ledgerEntries = $ledgerHelper->prepareLoanPaymentSchedule();
            }

            //Save to the database
            //Save to the DB
            foreach ($ledgerEntries AS $ent) {
                $ent->save(false);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->status = $stat;
            $model->approved_at = time();
            $model->approved_by = Yii::$app->member->id;
            return $this->render('disburse-loan', [
                        'model' => $model,
                        'loanId' => $id,
                        'ledgerDisbursementEntries' => $ledgerDisbursementEntries,
            ]);
        }
    }

    //Reverse Loan Application Loan
    public function actionReverseLoanApplication($id, $cat = 'LOAN', $stat = 3) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = new LoanManagerRemarks();
        $loan = $this->findLoanModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->db->createCommand('UPDATE loan SET status = 19 WHERE id =' . $id)->execute();
            //Go back tolist of clients
            Yii::$app->session->setFlash('success', 'You have successfully reversed Loan Application');

            return $this->redirect(['view', 'id' => $loan->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_id = $id;
            $model->client_id = $loan->client->id;
            $model->category = $cat;
            $model->remarks_status = $stat;
            return $this->render('reverse-loan-application', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
            ]);
        }
    }

    //Submit  Loan Application
    public function actionSubmitLoanApplication($id, $cat = 'LOAN', $stat = 87) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = new LoanManagerRemarks();
        $loan = $this->findLoanModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $sub = time();
            $user = Yii::$app->member->id;
            Yii::$app->db->createCommand('UPDATE loan SET status = 87,submitted_at= "' . $sub . '",submitted_by= "' . $user . '" WHERE id =' . $id)->execute();
            //Go back tolist of clients
            Yii::$app->session->setFlash('success', 'You have successfully submitted Loan Application for approval');

            //Send Emails to notify a new user that an account has been created
                             //Send Email
            Yii::$app->mailer->compose(['html' => 'officer-notification-html'], ['model' => $model])
                    ->setFrom('kumusoftcreditscore@gmail.com')
                    ->setTo($model->submittedTo->email)
                    ->setSubject('RESPONSE ' . $model->created_at . 'REQUEST MADE ON YOU')
                    ->send();
            return $this->redirect(['view', 'id' => $loan->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_id = $id;
            $model->client_id = $loan->client->id;
            $model->category = $cat;
            $model->remarks_status = $stat;
            return $this->render('submit-loan-application', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
            ]);
        }
    }

    //Submit  Loan Application
    public function actionSubmitToDirector($id, $cat = 'LOAN', $stat = 89) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = new LoanManagerRemarks();
        $loan = $this->findLoanModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $sub = time();
            $user = Yii::$app->member->id;
            Yii::$app->db->createCommand('UPDATE loan SET status = 89,manager_submitted_at= "' . $sub . '",manager_submitted_by= "' . $user . '" WHERE id =' . $id)->execute();
            //Go back tolist of clients
            Yii::$app->session->setFlash('success', 'You have successfully submitted Loan Application for approval');

            //Send Emails to notify a new user that an account has been created
                             //Send Email
            Yii::$app->mailer->compose(['html' => 'officer-notification-html'], ['model' => $model])
                    ->setFrom('kumusoftcreditscore@gmail.com')
                    ->setTo($model->submittedTo->email)
                    ->setSubject('RESPONSE ' . $model->loan->reference_number . 'APPLICATION ')
                    ->send();
            return $this->redirect(['view', 'id' => $loan->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_id = $id;
            $model->client_id = $loan->client->id;
            $model->category = $cat;
            $model->remarks_status = $stat;
            return $this->render('submit-to-director', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
            ]);
        }
    }

    //Return  Loan Application
    public function actionReturnLoanApplication($id, $cat = 'LOAN', $stat = 3) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = new LoanManagerRemarks();
        $loan = $this->findLoanModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->db->createCommand('UPDATE loan SET status = 88 WHERE id =' . $id)->execute();
            //Go back tolist of clients
            Yii::$app->session->setFlash('success', 'You have successfully returned Loan Application for works');

            return $this->redirect(['view', 'id' => $loan->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_id = $id;
            $model->client_id = $loan->client->id;
            $model->category = $cat;
            $model->remarks_status = $stat;
            return $this->render('return-loan-application', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
            ]);
        }
    }

    /**
     *  Approve Loan Application
     */
    public function actionUpdate($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $currency = ClientMasterData::findAll(['reference_table' => 'currency']);
            $amortization = ClientMasterData::findAll(['reference_table' => 'amortization_method']);
            $type = ClientMasterData::findAll(['reference_table' => 'loan_type']);
            $model->updated_at = time();
            $model->updated_by = Yii::$app->member->id;
            return $this->render('update', [
                        'model' => $model,
                        'currency' => $currency,
                        'amortization' => $amortization,
                        'type' => $type,
            ]);
        }
    }

    /**
     * Generate a payment schedule for a specified loan
     */
    public function actionGenerateSchedule($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        return $this->render('generate-schedule', ['model' => $model]);
    }

    //Download Loan Schedule

    public function actionDownloadLoanSchedule($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $user = Yii::$app->member;
        //Amortization Details
        $model = $this->findModel($id);
        //Content
        $content = $this->renderPartial('printable/schedule', [
            'model' => $model
        ]);

        $pdf = new mPdf(['default_font_size' => 10, 'default_font' => 'dejavusans']);
        $table_style = ".pdftable tbody tr:nth-child(even) {background-color: #eee;} .pdftable tbody tr td{color:#000;}  .pdftable thead tr th{color:#000;text-align:left;background-color:#daedf7;} .pdftable tr td, .pdftable tr th{border-bottom: 1px solid #ddd;}";
        $pdf->WriteHTML($table_style, 1);

        $pdf->SetFooter("Page {PAGENO} of {nb} | Served by {$user->fullnames} | Generated on {DATE jS F Y}");

        $pdf->AddPage('P', '', '', '', '', 10, 10, 5, 10, 10, 10);
        $pdf->WriteHTML($content, 2);

        return $pdf->Output(uniqid('schedule_') . '.pdf', 'D');
    }

    //Download Loan Schedule

    public function actionDownloadPaymentHistory($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $user = Yii::$app->member;
        //Amortization Details
        $model = $this->findModel($id);
        //Content
        $content = $this->renderPartial('printable/payment', [
            'model' => $model
        ]);

        $pdf = new mPdf(['default_font_size' => 10, 'default_font' => 'dejavusans']);
        $table_style = ".pdftable tbody tr:nth-child(even) {background-color: #eee;} .pdftable tbody tr td{color:#000;}  .pdftable thead tr th{color:#000;text-align:left;background-color:#daedf7;} .pdftable tr td, .pdftable tr th{border-bottom: 1px solid #ddd;}";
        $pdf->WriteHTML($table_style, 1);

        $pdf->SetFooter("Page {PAGENO} of {nb} | Served by {$user->fullnames} | Generated on {DATE jS F Y}");

        $pdf->AddPage('P', '', '', '', '', 10, 10, 5, 10, 10, 10);
        $pdf->WriteHTML($content, 2);

        return $pdf->Output(uniqid('payment_') . '.pdf', 'D');
    }

    /**
     * Save ledger entries (bills) associated to a loan
     * @param $id Unique Loan ID
     * @param $stage The stage at which we need to generate the entries
     */
    public function actionGenerateLedgerEntries($id, $stage) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "main_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "main_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "main_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "main_officer";
        } else {
            $this->layout = "main";
        }
        $ledgerHelper = new LedgerHelper(['tag' => $stage, 'loan_id' => $id]);
        $ledgerEntries = [];
        //Are we generating the payment schedule?
        if ($stage == 'approved') {
            $ledgerEntries = $ledgerHelper->prepareLoanScheduleEntries();
        } else {
            $ledgerEntries = $ledgerHelper->prepareLoanLedgerEntry();
        }
        //Save to the database
        //Save to the DB
        foreach ($ledgerEntries AS $ent) {
            $ent->save(false);
        }
        //Go back to the ledger generateion page
        return $this->redirect(['loan/generate-schedule', 'id' => $id]);
    }

    public function actionUpdateInterest($id, $ln) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "ledger_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "ledger_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "ledger_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "ledger_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findLedgerModel($id);
        $loan = $this->findLoanModel($ln);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $amountpaid = $model->amount; //amount paid by user
            $status = 0;

            if ($amountpaid <= 0) {
                $status = 43;
                //full paid
            } else {
                $status = 42; ///partially paid
            }
            //Update Payment status
            Ledger::updateAll(['ledger_status' => $status, 'interest_status' => $status], ['id' => $id]);
            return $this->redirect(['view', 'id' => $loan->id]);
        }

        return $this->render('update-interest', [
                    'model' => $model,
                    'ledgerId' => $id,
        ]);
    }

    // Rate Client
    public function actionRateClient($id, $ln) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findScoreModel($id);
        $loan = $this->findModel($ln);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-rating-plate', 'id' => $loan->id]);
        }

        return $this->render('rate-client', [
                    'model' => $model,
                    'loan' => $loan,
                    'loanId' => $ln,
        ]);
    }

    // Check Requirements
    public function actionCheckRequirements($id, $ln, $stat = 1) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "loan_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "loan_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "loan_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "loan_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findRequirementModel($id);
        $loan = $this->findModel($ln);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-requirements-plate', 'id' => $loan->id]);
        } else {
            $model->status = $stat;
            $member = ClientMasterData::findAll(['reference_table' => 'staff_member']);
            return $this->render('check-requirements', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
                        'member' => $member,
            ]);
        }
    }

    /**
     * Deletes an existing Loan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Loan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Loan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Loan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findInvestmentModel($id) {
        if (($model = Investment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //Get the Client Applying for a loan

    protected function findClientModel($id) {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //Get Loan Applied

    protected function findLoanModel($id) {
        if (($model = Loan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //Get Loan Applied

    protected function findLoanScheduleModel($id) {
        if (($model = LoanPaymentSchedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findLedgerModel($id) {
        if (($model = Ledger::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findScoreModel($id) {
        if (($model = Score::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findRequirementModel($id) {
        if (($model = BorrowerCheckList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
