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
use yii\web\UploadedFile;
use common\models\client\LoanManagerRemarks;
use common\models\client\LoanManagerRemarksSearch;

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
        $loan = $this->findLoanModel($id);
        $searchModel = new LoanGuarantorSearch();
        $searchModel->loan_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('loan-guarantors', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'loan' => $loan,
        ]);
    }

    /**
     * List of Loan Collateral Uploads.
     * @return mixed
     */
    public function actionLoanCollateral($id) {
        $loan = $this->findLoanModel($id);
        $searchModel = new LoanCollateralSearch();
        $searchModel->loan_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('loan-collateral', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'loan' => $loan,
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
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * New Loan Application
     */
    public function actionNewLoanApplication($id, $stat = 19) {
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
                        'currency' => $currency,
            ]);
        }
    }

    public function actionAddLoanGuarantor($id) {
        $model = new LoanGuarantor();
        $loan = $this->findLoanModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['loan-guarantors','id' => $loan->id]);
        } else {
            $ident = MasterData::findAll(['reference_table' => 'identification_type']);
            $sex = MasterData::findAll(['reference_table' => 'sex']);
            $model->created_at = time();
            $model->loan_id = $id;
            $model->created_by = Yii::$app->member->id;
            return $this->render('add-loan-guarantor', [
                        'model' => $model,
                        'loan' => $loan,
                        'ident' => $ident,
                        'sex' => $sex,
            ]);
        }
    }

    public function actionAddLoanCollateral($id) {
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
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_id = $id;
            return $this->render('add-loan-collateral', [
                        'model' => $model,
                        'loan' => $loan,
                        'type' => $type,
            ]);
        }
    }

    /**
      Approve Loan Application
     */
    public function actionApproveLoanApplication($id, $stat = 20) {
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
                        'method' => $method,
            ]);
        }
    }

    /**
      Loan Disbursement
     */
    public function actionDisburseLoan($id, $stat = 41) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            $model->approved_at = time();
            $model->approved_by = Yii::$app->member->id;
            $model->status = $stat;
            return $this->render('disburse-loan', [
                        'model' => $model,
            ]);
        }
    }

    //Approve a client
    public function actionRejectLoanApplication($id, $cat = 'LOAN') {
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
            return $this->render('reject-loan-application', [
                        'model' => $model,
                        'loan' => $loan,
            ]);
        }
    }

    /**
      Approve Loan Application
     */
    public function actionUpdate($id) {
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
