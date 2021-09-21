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
use common\models\client\MasterData;
use common\models\client\LoanCollateral;
use common\models\client\LoanCollateralSearch;
use common\models\client\ChartOfAccounts;
use yii\web\UploadedFile;
use common\models\client\LoanManagerRemarks;
use common\models\client\LoanManagerRemarksSearch;
use common\models\client\LoanAmortization;
use common\models\loan\LedgerTransactionConfig;
use common\models\loan\LedgerHelper;
use common\models\loan\Ledger;
use common\models\loan\LedgerPayment;
use common\models\ReferenceHelper;
/**
 * LoanController implements the CRUD actions for Loan model.
 */
class LoanController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists of Loan Applications.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LoanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists of Approved Loan Applications.
     * @return mixed
     */
    public function actionLoanApplications($id) {
        $this->layout = "clientprofile";
        $client = $this->findClientModel($id);
        $searchModel = new LoanSearch();
        $searchModel->client_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('loan-applications', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'client' => $client,
                    'clientId' => $id,
        ]);
    }

    /**
     * Lists of Approved Loan Applications.
     * @return mixed
     */
    public function actionApprovedLoanApplications() {
        $searchModel = new LoanSearch();
        $searchModel->status = 20;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        $searchModel = new LoanSearch();
        $searchModel->status = 41;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('disbursed-loan-applications', [
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
        $searchModel = new LoanSearch();
        $searchModel->status = 36;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        $this->layout = "loan";
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

    /**
     * List of Loan Collateral Uploads.
     * @return mixed
     */
    public function actionLoanCollateral($id) {
        $this->layout = "loan";
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
     * Displays a single Loan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $this->layout = "loan";
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a payment history for the loan
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPaymentHistory($id) {
        $this->layout = "loan";
        return $this->render('payment-history', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Make payment
     */
    public function actionPay($id,$ledger){
        $this->layout = "loan";
        $payledgers = explode(",",$ledger);
        $payment = new LedgerPayment();
        $ledgers = Ledger::find()->where(['id'=>$payledgers])->all();
        
        //If we have managed to load and save the payment...
        if ($payment->load(Yii::$app->request->post())){
        $payment->reference_no = ReferenceHelper::getPaymentReferenceNumber();
        //Advance payment=Amount Paid-Amount Expected
        $payment->advance_payment = ($payment->amount_paid-$payment->bill_total);
        //Save Payment
        $payment->save(false);
        //Save Ledger records for this payment...
        $ledgerPayments = LedgerHelper::setLedgerPayment($payment,$ledgers);
            foreach($ledgerPayments AS $lg){
                $lg->save(false);
            }
        //Update Payment status
        Ledger::updateAll(['ledger_status'=>Ledger::STATUS_PAID],['id'=>$payledgers]);
        //Go back to payment history
        return $this->redirect(['payment-history','id'=>$id]);
        }else{
        $pay_accounts = ChartOfAccounts::find()
                ->where(['like','gl_code','121'])
                ->andWhere(['>','gl_code','12100'])
                ->all();
        $payment_methods = MasterData::find()
                ->where(['reference_table'=>'payment_method'])
                ->all();
        return $this->render('pay',
            [
                'model' => $this->findModel($id),
                'ledgers'=>$ledgers,
                'pay_ledgers'=>$ledger,
                'payment'=>$payment,
                'total'=>array_sum(array_column($ledgers,'amount')),
                'pay_accounts'=>$pay_accounts,
                'payment_methods'=>$payment_methods
            ]
        );
     }
    }

    /**
     * New Loan Application
     */
    public function actionNewLoanApplication($id, $stat = 19) {
        $this->layout = "clientprofile";
        $model = new Loan();
        $client = $this->findClientModel($id);
        $loan = $this->findLoanModel($id);
        if (Yii::$app->request->isAjax && $model->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['add-loan-guarantor', 'id' => $loan->id]);
        } else {
            $currency = MasterData::findAll(['reference_table' => 'currency']);
            $model->created_at = time();
            $model->client_id = $id;
            $model->created_by = Yii::$app->member->id;
            //$model->reference_number = $model->generateReferenceNumber();
            $model->status = $stat;
            return $this->render('new-loan-application', [
                        'model' => $model,
                        'client' => $client,
                        'loan' => $loan,
                        'clientId' => $id,
                        'currency' => $currency,
            ]);
        }
    }

    public function actionAddLoanGuarantor($id) {
        $this->layout = "loan";
        $model = new LoanGuarantor();
        $loan = $this->findLoanModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['loan-guarantors', 'id' => $loan->id]);
        } else {
            $ident = MasterData::findAll(['reference_table' => 'identification_type']);
            $sex = MasterData::findAll(['reference_table' => 'sex']);
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
        $this->layout = "loan";
        $model = new LoanCollateral();
        $loan = $this->findLoanModel($id);
        if (Yii::$app->request->isPost) {
            $name = uniqid();
            $model->proof_of_ownership = UploadedFile::getInstance($model, 'proof_of_ownership');
            $filename = $name . '.' . $model->proof_of_ownership->extension;
            $dir = Yii::getAlias('@dir_htmlassets') . '/collateral/';
            //Try to save
            $model->proof_of_ownership->saveAs($dir . "/" . $filename);

            $model->load(Yii::$app->request->post());
            $model->proof_of_ownership = $filename;
            $model->save(false);
            return $this->redirect(['loan-collateral', 'id' => $loan->id]);
        } else {
            $type = MasterData::findAll(['reference_table' => 'type_of_collateral']);
            $ownership = MasterData::findAll(['reference_table' => 'type_of_ownership']);
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_id = $id;
            return $this->render('add-loan-collateral', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
                        'type' => $type,
                        'ownership' => $ownership,
            ]);
        }
    }

    /**
      Approve Loan Application
     */
    public function actionApproveLoanApplication($id, $stat = 20) {
        $this->layout = "loan";
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            $method = MasterData::findAll(['reference_table' => 'amortization_method']);
            $model->approved_at = time();
            $model->approved_by = Yii::$app->member->id;
            $model->status = $stat;
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
    public function actionDisburseLoan($id, $cat = 'LOAN',$stat = 4) {
        $this->layout = "loan";
        $model = new LoanManagerRemarks();
        $loan = $this->findLoanModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->db->createCommand('UPDATE loan SET status = 41 WHERE id =' . $id)->execute();
            Yii::$app->session->setFlash('success', 'You have successfully disbursed Loan');
            return $this->redirect(['disbursed-loan-applications']);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_id = $id;
            $model->category = $cat;
            $model->remarks_status = $stat;
            return $this->render('disburse-loan', [
                        'model' => $model,
                        'loan' => $loan,
                        'loanId' => $id,
            ]);
        }
    }

    //Reject Loan Application Loan
    public function actionRejectLoanApplication($id, $cat = 'LOAN', $stat = 3) {
        $this->layout = "loan";
        $model = new LoanManagerRemarks();
        $loan = $this->findLoanModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->db->createCommand('UPDATE loan SET status = 36 WHERE id =' . $id)->execute();
            //Go back tolist of clients
            Yii::$app->session->setFlash('success', 'You have successfully rejected Loan Application');
            //Send Email
            Yii::$app->mailer->compose(['html' => 'rejection-notification-html'], ['loan' => $model])
                    ->setFrom('kumusoftcreditscore@gmail.com')
                    ->setTo($model->loan->client->email)
                    ->setSubject('LOAN APPLICATION ' . $model->loan->reference_number)
                    ->send();
            return $this->redirect(['loan/index']);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_id = $id;
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
     *  Approve Loan Application
     */
    public function actionUpdate($id) {
        $this->layout = "loan";
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            $currency = MasterData::findAll(['reference_table' => 'currency']);
            $model->updated_at = time();
            $model->updated_by = Yii::$app->member->id;
            return $this->render('update', [
                        'model' => $model,
                        'currency' => $currency,
            ]);
        }
    }

    /**
     * Generate a payment schedule for a specified loan
     */
    public function actionGenerateSchedule($id){
         $this->layout = "loan";
        $model = $this->findModel($id);
        return $this->render('generate-schedule',['model'=>$model]);
    }

    /**
     * Save ledger entries (bills) associated to a loan
     * @param $id Unique Loan ID
     * @param $stage The stage at which we need to generate the entries
     */
    public function actionGenerateLedgerEntries($id,$stage){
        $ledgerHelper = new LedgerHelper(['tag'=>$stage,'loan_id'=>$id]);
        $ledgerEntries=[];
        //Are we generating the payment schedule?
        if($stage=='approved'){
            $ledgerEntries = $ledgerHelper->prepareLoanScheduleEntries();
        }else{
            $ledgerEntries = $ledgerHelper->prepareLoanLedgerEntry();
        }
        //Save to the database
         //Save to the DB
        foreach($ledgerEntries AS $ent){
            $ent->save(false);
        }
        //Go back to the ledger generateion page
        return $this->redirect(['loan/generate-schedule','id'=>$id]);
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

}
