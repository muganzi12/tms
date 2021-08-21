<?php

namespace frontend\controllers;

use Yii;
use common\models\client\Client;
use common\models\client\ClientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\client\MasterData;
use common\models\client\ClientDocuments;
use yii\web\UploadedFile;
use common\models\client\ClientDocumentsSearch;
use common\models\client\LoanManagerRemarks;
use common\models\client\LoanManagerRemarksSearch;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class ClientController extends Controller {

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
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ClientSearch();
        $searchModel->person_scenario = "CLIENT";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNextOfKin($id) {
        $model = $this->findModel($id);
        $searchModel = new ClientSearch();
        $searchModel->person_scenario = "NEXTOFKIN";
        $searchModel->related_to = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('next-of-kin', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    public function actionUploadedDocuments($id) {
        $model = $this->findModel($id);
        $searchModel = new ClientDocumentsSearch();
        $searchModel->client_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('uploaded-documents', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single Member model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $this->layout="clientprofile";
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'clientId'=>$id
        ]);
    }

    //Register New Member
    public function actionAddNewClient($stat = 19, $person_scenario = 'CLIENT') {
        $model = new Client();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //Registar a new Next of Kin
            return $this->redirect(['client/add-next-of-kin', 'id' => $model->id]);
        } else {
            $ident = MasterData::findAll(['reference_table' => 'identification_type']);
            $sex = MasterData::findAll(['reference_table' => 'sex']);
            $marital = MasterData::findAll(['reference_table' => 'marital_status']);
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->status = $stat;
            $model->person_scenario = $person_scenario;
            $model->reference_number = $model->generateReferenceNumber();
            return $this->render('add-new-client', [
                        'model' => $model,
                        'ident' => $ident,
                        'sex' => $sex,
                        'marital' => $marital,
            ]);
        }
    }

    public function actionAddNextOfKin($id, $stat = 19, $person_scenario = 'NEXTOFKIN') {
        $model = new Client();
        $client = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['next-of-kin', 'id' => $client->id]);
        } else {
            $ident = MasterData::findAll(['reference_table' => 'identification_type']);
            $sex = MasterData::findAll(['reference_table' => 'sex']);
            $marital = MasterData::findAll(['reference_table' => 'marital_status']);
            $relationship = MasterData::findAll(['reference_table' => 'relationship']);
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->status = $stat;
            $model->related_to = $id;
            $model->person_scenario = $person_scenario;
            return $this->render('add-next-of-kin', [
                        'model' => $model,
                        'client' => $client,
                        'ident' => $ident,
                        'sex' => $sex,
                        'marital' => $marital,
                        'relationship' => $relationship,
            ]);
        }
    }

    public function actionUploadDocument($id) {
        $model = new ClientDocuments();
        $client = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $name = uniqid();
            $model->file_name = UploadedFile::getInstance($model, 'file_name');
            $filename = $name . '.' . $model->file_name->extension;
            $dir = Yii::getAlias('@dir_htmlassets') . '/uploads/';
            //Try to save
            $model->file_name->saveAs($dir . "/" . $filename);

            $model->load(Yii::$app->request->post());
            $model->file_name = $filename;
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->client_id = $id;
            return $this->render('upload-document', [
                        'model' => $model,
                        'client' => $client,
            ]);
        }
    }

    //Upload Passport Picture
    public function actionUploadPhoto($id) {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $sign = UploadedFile::getInstanceByName('Client[passport_photo]');
            //try to upload
            $filename = $model->reference_number . '_logo.' . $sign->extension;
            $dir = Yii::getAlias('@dir_htmlassets');
            //Try to save
            $sign->saveAs($dir . "/passport/" . $filename);
            //Update member details
            $model->passport_photo = $filename;
            $model->save(false);
            Yii::$app->session->setFlash('success', 'You Successfully Uploaded Passport Photo ');
            return $this->redirect(['view','id'=>$model->id]);
        } else {
            return $this->render('upload-photo', ['model' => $model]);
        }
    }

    //Approve a client
    public function actionApproveClient($id, $cat = 'CLIENT') {
        $model = new LoanManagerRemarks();
        $client = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->db->createCommand('UPDATE client SET status = 20 WHERE id =' . $id)->execute();
            //Go back tolist of clients
            Yii::$app->session->setFlash('success', 'Client successfully approved');
            return $this->redirect(['client/index']);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->client_id = $id;
            $model->category = $cat;
            return $this->render('approve-client', [
                        'model' => $model,
                        'client' => $client,
            ]);
        }
    }

    /**
     * Lists all LoanManagerRemarks models.
     * @return mixed
     */
    public function actionApprovalRemarks($id, $cat = "CLIENT") {
        $client = $this->findModel($id);
        $searchModel = new LoanManagerRemarksSearch();
        $searchModel->client_id = $id;
        $searchModel->category = "CLIENT";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('approval-remarks', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'client' => $client,
        ]);
    }

    public function actionRejectionRemarks($id, $cat = "CLIENT") {
        $client = $this->findModel($id);
        $searchModel = new LoanManagerRemarksSearch();
        $searchModel->client_id = $id;
        $searchModel->category = $cat;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('rejection-remarks', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'client' => $client,
        ]);
    }

    //Reject a client
    public function actionRejectClient($id, $cat = 'CLIENT') {
        $model = new LoanManagerRemarks();
        $client = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->db->createCommand('UPDATE client SET status = 36 WHERE id =' . $id)->execute();
            //Go back tolist of clients
            Yii::$app->session->setFlash('success', 'Client successfully approved');
            return $this->redirect(['client/index']);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->client_id = $id;
            $model->category = $cat;
            return $this->render('reject-client', [
                        'model' => $model,
                        'client' => $client,
            ]);
        }
    }

    /**
     * Updates an existing Member model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $this->layout="clientprofile";
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->updated_at = time();
            $model->updated_by = Yii::$app->member->id;
            $model->reference_number = $model->generateReferenceNumber();
            $ident = MasterData::findAll(['reference_table' => 'identification_type']);
            $sex = MasterData::findAll(['reference_table' => 'sex']);
            $marital = MasterData::findAll(['reference_table' => 'marital_status']);
            return $this->render('update', [
                        'model' => $model,
                        'ident' => $ident,
                        'sex' => $sex,
                        'marital' => $marital,
            ]);
        }
    }

    //Update Next of Kin
    public function actionUpdateNextOfKin($id, $memb) {
        $model = $this->findModel($id);
        $client = $this->findModel($memb);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['next-of-kin', 'id' => $client->id]);
        } else {
            $model->updated_at = time();
            $model->updated_by = Yii::$app->member->id;
            $ident = MasterData::findAll(['reference_table' => 'identification_type']);
            $sex = MasterData::findAll(['reference_table' => 'sex']);
            $marital = MasterData::findAll(['reference_table' => 'marital_status']);
            $relationship = MasterData::findAll(['reference_table' => 'relationship']);
            return $this->render('update-next-of-kin', [
                        'model' => $model,
                        'client' => $client,
                        'ident' => $ident,
                        'sex' => $sex,
                        'marital' => $marital,
                        'relationship' => $relationship,
            ]);
        }
    }

    /**
     * Deletes an existing Member model.
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
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
