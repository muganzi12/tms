<?php

namespace frontend\controllers;

use Yii;
use common\models\client\Investor;
use common\models\client\InvestorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\client\ClientMasterData;
use common\models\client\Investment;
use common\models\client\InvestmentSearch;
use yii\web\UploadedFile;
use common\models\ReferenceHelper;
use common\models\loan\LedgerHelper;
use common\models\loan\LedgerInvestmentHelper;
use common\models\client\LoanManagerRemarks;
use common\models\client\LoanManagerRemarksSearch;

/**
 * InvestorController implements the CRUD actions for Investor model.
 */
class InvestorController extends Controller {

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
     * Lists all Investor models.
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
        $searchModel = new InvestorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInvestments($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "investorprofile_admin_invest";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "investorprofile_manager_invest";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "investorprofile_director_invest";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "investorprofile_officer_invest";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        $searchModel = new InvestmentSearch();
        $searchModel->investor_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('investments', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'investorId' => $id
        ]);
    }

    /**
     * Displays a single Investor model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionInvestmentDetails($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "investmentprofile_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "investmentprofile_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "investmentprofile_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "investmentprofile_officer";
        } else {
            $this->layout = "main";
        }
        return $this->render('investment-details', [
                    'model' => $this->findInvestmentModel($id),
                    'investorId' => $id
        ]);
    }

    /**
     * Displays a single Investor model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "investorprofile_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "investorprofile_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "investorprofile_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "investorprofile_officer";
        } else {
            $this->layout = "main";
        }
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'investorId' => $id
        ]);
    }

    /**
     * Creates a new Investor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddNewInvestor($stat = 1) {
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
        $model = new Investor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $ident = ClientMasterData::findAll(['reference_table' => 'identification_type']);
            $sex = ClientMasterData::findAll(['reference_table' => 'sex']);
            $invest = ClientMasterData::findAll(['reference_table' => 'invest']);
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->status = $stat;
            $model->reference_number = ReferenceHelper::getClientReferenceNumber('INVESTOR');
            return $this->render('add-new-investor', [
                        'model' => $model,
                        'ident' => $ident,
                        'sex' => $sex,
                        'invest' => $invest,
            ]);
        }
    }

    public function actionAddNewInvestment($id, $stat = 19, $cat = 'INVESTMENT', $type = 56, $stage = 'investment') {
       if (Yii::$app->member->office_id === 1) {
            $this->layout = "investorprofile_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "investorprofile_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "investorprofile_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "investorprofile_officer";
        } else {
            $this->layout = "main";
        }
        $model = new Investment();
        $investment = $this->findModel($id);
        $ledgerHelper = new LedgerHelper(['tag' => $stage, 'investment_id' => $id]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //Upload Proof of Paymnent
            $timenow = uniqid();
            $model->proof_of_investment = UploadedFile::getInstance($model, 'proof_of_investment');

            if (!empty($model->proof_of_investment)) {
                $dir = Yii::getAlias('@dir_htmlassets') . '/payments';
                //Try to save
                //$model->proof_of_ownership->saveAs($dir . "/" . $filename);
                $model->proof_of_investment->saveAs($dir . "/" . $timenow . '.' . $model->proof_of_investment->extension);

                //save the path in the db

                $model->proof_of_investment = $timenow . '.' . $model->proof_of_investment->extension;
                //$payment->proof_attachment = $filename;
            }
            $model->save(false);
            return $this->redirect(['investments', 'id' => $investment->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->investor_id = $id;
            $model->status = $stat;
            $model->loan_type = $type;
            $model->reference_number = ReferenceHelper::getClientReferenceNumber('INVESTMENT');
            return $this->render('add-new-investment', [
                        'model' => $model,
                        'investment' => $investment,
                        'investorId' => $id,
            ]);
        }
    }

    //Upload Passport Picture
    public function actionUploadPhoto($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "investorprofile_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "investorprofile_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "investorprofile_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "investorprofile_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $sign = UploadedFile::getInstanceByName('Investor[profile_pic]');
            //try to upload
            $filename = $model->firstname . '_pic.' . $sign->extension;
            $dir = Yii::getAlias('@dir_htmlassets');
            //Try to save
            $sign->saveAs($dir . "/passport/" . $filename);
            //Update member details
            $model->profile_pic = $filename;
            $model->save(false);
            Yii::$app->session->setFlash('success', 'You Successfully Uploaded Passport Photo ');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('upload-photo', ['model' => $model, 'investorId' => $id,]);
        }
    }

    /**
     * Updates an existing Investor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
    if (Yii::$app->member->office_id === 1) {
            $this->layout = "investorprofile_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "investorprofile_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "investorprofile_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "investorprofile_officer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //Are we generating the payment schedule?
            if ($stage == 'application') {
                $ledgerEntries = $ledgerHelper->prepareInvestmentEntries();
            }
            //Save to the database
            //Save to the DB
            foreach ($ledgerEntries AS $ent) {
                $ent->save(false);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $ident = ClientMasterData::findAll(['reference_table' => 'identification_type']);
            $sex = ClientMasterData::findAll(['reference_table' => 'sex']);
            $invest = ClientMasterData::findAll(['reference_table' => 'invest']);
            $model->updated_at = time();
            $model->updated_by = Yii::$app->member->id;

            return $this->render('update', [
                        'model' => $model,
                        'ident' => $ident,
                        'invest' => $invest,
                        'sex' => $sex,
                        'investorId' => $id
            ]);
        }
    }

    /**
      Approve Loan Application
     */
    public function actionApproveInvestment($id, $cat = 'INVESTMENT', $stat = 20, $stage = 'application') {
         if (Yii::$app->member->office_id === 1) {
            $this->layout = "investmentprofile_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "investmentprofile_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "investmentprofile_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "investmentprofile_officer";
        } else {
            $this->layout = "main";
        }
        $model = new LoanManagerRemarks();
        $investment = $this->findInvestmentModel($id);
        $ledgerHelper = new LedgerInvestmentHelper(['tag' => $stage, 'investment_id' => $id]);
        $ledgerEntries = [];
        if (Yii::$app->request->isAjax && $model->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //Are we generating the payment schedule?
            if ($stage == 'application') {
                $ledgerEntries = $ledgerHelper->prepareInvestmentEntries();
            }
            //Save to the database
            //Save to the DB
            foreach ($ledgerEntries AS $ent) {
                $ent->save(false);
            }

            Yii::$app->db->createCommand('UPDATE investment SET status = 20 WHERE id =' . $id)->execute();
            //Go back tolist of clients
            Yii::$app->session->setFlash('success', 'Investment successfully approved');
            return $this->redirect(['investments', 'id' => $investment->investor->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->investment_id = $id;
            $model->category = $cat;
            $model->remarks_status = $stat;
            return $this->render('approve-investment', [
                        'model' => $model,
                        'investment' => $investment,
                        'investmentId' => $id,
                        'ledgerEntries' => $ledgerEntries,
            ]);
        }
    }

    /**
     * Deletes an existing Investor model.
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
     * Finds the Investor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Investor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Investor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Investor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Investor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findInvestmentModel($id) {
        if (($model = Investment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
