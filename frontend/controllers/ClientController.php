<?php

namespace frontend\controllers;

use Yii;
use common\models\client\Client;
use common\models\client\ClientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\client\ClientMasterData;
use common\models\client\ClientDocuments;
use yii\web\UploadedFile;
use common\models\client\ClientDocumentsSearch;
use common\models\client\LoanManagerRemarks;
use common\models\client\LoanManagerRemarksSearch;
use common\models\ReferenceHelper;
use common\models\client\LoanGuarantor;
use yii\filters\AccessControl;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class ClientController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['download'],
                'rules' => [
                    [
                        'actions' => ['download', 'view', 'delete', 'upate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Member models.
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
        $model = new Client();
        $searchModel = new ClientSearch();
        $searchModel->person_scenario = "CLIENT";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 1000;
        $dataProvider->sort = ['defaultOrder' => ['created_at' => 'SORT_DESC']];
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model'=>$model,
        ]);
    }

    /**
     * Lists all Member models.
     * @return mixed
     */
    public function actionInvestors() {
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
        $searchModel = new ClientSearch();
        $searchModel->person_scenario = "INVESTOR";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('investors', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNextOfKin($id) {
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

         if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin_documents";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager_documents";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector_documents";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer_documents";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        $searchModel = new ClientDocumentsSearch();
        $searchModel->client_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('uploaded-documents', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'clientId' => $id
        ]);
    }

    /**
     * Displays a single Member model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'clientId' => $id
        ]);
    }

    /**
     * Displays a single Member model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActivityLogs($id) {
          if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin_logs";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager_logs";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector_logs";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer_logs";
        } else {
            $this->layout = "main";
        }
        return $this->render('activity-logs', [
                    'model' => $this->findModel($id),
                    'clientId' => $id
        ]);
    }

    //Register New Member
    public function actionAddNewClient($stat = 19, $person_scenario = 'CLIENT', $nstat = 19) {
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
        $model = new Client();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //Registar a new Next of Kin
            return $this->redirect(['client/add-next-of-kin', 'id' => $model->id]);
        } else {
            $ident = ClientMasterData::findAll(['reference_table' => 'identification_type']);
            $sex = ClientMasterData::findAll(['reference_table' => 'sex']);
            $marital = ClientMasterData::findAll(['reference_table' => 'marital_status']);
            $client = ClientMasterData::findAll(['reference_table' => 'client_type']);
            $office = ClientMasterData::findAll(['reference_table' => 'office_type']);
            $address = ClientMasterData::findAll(['reference_table' => 'address_type']);
            $classification = ClientMasterData::findAll(['reference_table' => 'classification_status']);
            $member = ClientMasterData::findAll(['reference_table' => 'staff_member']);
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->status = $stat;
            $model->person_scenario = $person_scenario;
            $model->next_kin_status = $nstat;
            $model->account_number = ReferenceHelper::getClientReferenceNumber('CLIENT');
            return $this->render('add-new-client', [
                        'model' => $model,
                        'ident' => $ident,
                        'sex' => $sex,
                        'marital' => $marital,
                        'client' => $client,
                        'office' => $office,
                        'address' => $address,
                        'classification' => $classification,
                        'member' => $member,
            ]);
        }
    }

    public function actionAddNextOfKin($id, $stat = 19, $person_scenario = 'NEXTOFKIN', $office = 47) {
         if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
        $model = new Client();
        $client = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->db->createCommand('UPDATE client SET next_kin_status = 20 WHERE id =' . $id)->execute();
            return $this->redirect(['next-of-kin', 'id' => $client->id]);
        } else {
            $ident = ClientMasterData::findAll(['reference_table' => 'identification_type']);
            $sex = ClientMasterData::findAll(['reference_table' => 'sex']);
            $marital = ClientMasterData::findAll(['reference_table' => 'marital_status']);
            $relationship = ClientMasterData::findAll(['reference_table' => 'relationship']);
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->status = $stat;
            $model->related_to = $id;
            $model->person_scenario = $person_scenario;
            $model->office_id = $office;
            $model->account_number = ReferenceHelper::getClientReferenceNumber('NEXTOFKIN');
            return $this->render('add-next-of-kin', [
                        'model' => $model,
                        'client' => $client,
                        'ident' => $ident,
                        'sex' => $sex,
                        'clientId' => $id,
                        'marital' => $marital,
                        'relationship' => $relationship,
            ]);
        }
    }

    public function actionAddLoanGuarantor($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
        $model = new LoanGuarantor();
        $client = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['loan-guarantors', 'id' => $client->id]);
        } else {
            $ident = ClientMasterData::findAll(['reference_table' => 'identification_type']);
            $sex = ClientMasterData::findAll(['reference_table' => 'sex']);
            $model->created_at = time();
            $model->client_id = $id;
            $model->created_by = Yii::$app->member->id;
            return $this->render('add-loan-guarantor', [
                        'model' => $model,
                        'client' => $client,
                        'clientId' => $id,
                        'ident' => $ident,
                        'sex' => $sex,
            ]);
        }
    }

    public function actionUploadDocument($id) {
         if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
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
            return $this->redirect(['uploaded-documents', 'id' => $client->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->client_id = $id;
            return $this->render('upload-document', [
                        'model' => $model,
                        'client' => $client,
                        'clientId' => $id,
            ]);
        }
    }

    //Upload Passport Picture
    public function actionUploadPhoto($id) {
          if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $sign = UploadedFile::getInstanceByName('Client[passport_photo]');
            //try to upload
            $filename = $model->account_number . '_logo.' . $sign->extension;
            $dir = Yii::getAlias('@dir_htmlassets');
            //Try to save
            $sign->saveAs($dir . "/passport/" . $filename);
            //Update member details
            $model->passport_photo = $filename;
            $model->save(false);
            Yii::$app->session->setFlash('success', 'You Successfully Uploaded Passport Photo ');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('upload-photo', ['model' => $model, 'clientId' => $id,]);
        }
    }

    //Approve a client
    public function actionApproveClient($id, $cat = 'CLIENT', $status = 1) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
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
            $model->remarks_status = $status;
            return $this->render('approve-client', [
                        'model' => $model,
                        'client' => $client,
                        'clientId' => $id,
            ]);
        }
    }

    /**
     * Lists all LoanManagerRemarks models.
     * @return mixed
     */
    public function actionApprovalRemarks($id, $cat = "CLIENT", $status = 1) {
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
        $client = $this->findModel($id);
        $searchModel = new LoanManagerRemarksSearch();
        $searchModel->client_id = $id;
        $searchModel->category = "CLIENT";
        $searchModel->remarks_status = $status;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('approval-remarks', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'client' => $client,
        ]);
    }

    public function actionRejectionRemarks($id, $cat = "CLIENT", $status = 2) {
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
        $client = $this->findModel($id);
        $searchModel = new LoanManagerRemarksSearch();
        $searchModel->client_id = $id;
        $searchModel->category = $cat;
        $searchModel->remarks_status = $status;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('rejection-remarks', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'client' => $client,
        ]);
    }

    //Reject a client
    public function actionRejectClient($id, $cat = 'CLIENT', $status = 2) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
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
            $model->remarks_status = $status;
            return $this->render('reject-client', [
                        'model' => $model,
                        'client' => $client,
                        'clientId' => $id,
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
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->updated_at = time();
            $model->updated_by = Yii::$app->member->id;
            $ident = ClientMasterData::findAll(['reference_table' => 'identification_type']);
            $sex = ClientMasterData::findAll(['reference_table' => 'sex']);
            $marital = ClientMasterData::findAll(['reference_table' => 'marital_status']);
            $client = ClientMasterData::findAll(['reference_table' => 'client_type']);
            $office = ClientMasterData::findAll(['reference_table' => 'office_type']);
            $address = ClientMasterData::findAll(['reference_table' => 'address_type']);
            $classification = ClientMasterData::findAll(['reference_table' => 'classification_status']);
            $member = ClientMasterData::findAll(['reference_table' => 'staff_member']);
            return $this->render('update', [
                        'model' => $model,
                        'ident' => $ident,
                        'sex' => $sex,
                        'clientId' => $id,
                        'marital' => $marital,
                        'client' => $client,
                        'office' => $office,
                        'address' => $address,
                        'classification' => $classification,
                        'member' => $member,
            ]);
        }
    }

    //Update Next of Kin
    public function actionUpdateNextOfKin($id, $client) {
         if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findModel($id);
        $client = $this->findModel($client);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $client->id]);
        } else {
            $model->updated_at = time();
            $model->updated_by = Yii::$app->member->id;
            $ident = ClientMasterData::findAll(['reference_table' => 'identification_type']);
            $sex = ClientMasterData::findAll(['reference_table' => 'sex']);
            $marital = ClientMasterData::findAll(['reference_table' => 'marital_status']);
            $relationship = ClientMasterData::findAll(['reference_table' => 'relationship']);
            return $this->render('update-next-of-kin', [
                        'model' => $model,
                        'ident' => $ident,
                        'client' => $client,
                        'sex' => $sex,
                        'clientId' => $id,
                        'marital' => $marital,
                        'relationship' => $relationship,
            ]);
        }
    }

    //Update Suuporting Documents
    public function actionUpdateDocument($id, $memb) {
          if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
        $model = $this->findDocumentModel($id);
        $client = $this->findModel($memb);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['uploaded-documents', 'id' => $client->id]);
        } else {
            $model->updated_at = time();
            $model->updated_by = Yii::$app->member->id;
            return $this->render('update-document', [
                        'model' => $model,
                        'client' => $client,
                        'clientId' => $memb,
            ]);
        }
    }

    public function actionImport() {
        $modelImport = new \yii\base\DynamicModel([
            'fileImport' => 'File Import',
        ]);
        $modelImport->addRule(['fileImport'], 'required');
        $modelImport->addRule(['fileImport'], 'file', ['extensions' => 'xls,xlsx'], ['maxSize' => 1024 * 1024]);

        if (Yii::$app->request->post()) {
            $modelImport->fileImport = UploadedFile::getInstance($modelImport, 'fileImport');
            if ($modelImport->fileImport && $modelImport->validate()) {
                $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $baseRow = 2;
                while (!empty($sheetData[$baseRow]['A'])) {
                    $model = new Client;
                    $model->account_number = (string) $sheetData[$baseRow]['A'];
                    $model->firstname = (string) $sheetData[$baseRow]['B'];
                    $model->lastname = (string) $sheetData[$baseRow]['C'];
                    $model->othername = (string) $sheetData[$baseRow]['D'];
                    $model->office_id = (string) $sheetData[$baseRow]['E'];
                    $model->identification_number = (string) $sheetData[$baseRow]['F'];
                    $model->identification_type = (int) $sheetData[$baseRow]['G'];
                    $model->alt_telephone = (string) $sheetData[$baseRow]['H'];
                    $model->telephone = (string) $sheetData[$baseRow]['I'];
                    $model->email = (string) $sheetData[$baseRow]['J'];
                    $model->gender = (int) $sheetData[$baseRow]['K'];
                    $model->marital_status = (int) $sheetData[$baseRow]['L'];
                    $model->date_of_birth = (string) $sheetData[$baseRow]['M'];
                    $model->address_type = (int) $sheetData[$baseRow]['N'];
                    $model->address = (string) $sheetData[$baseRow]['O'];
                    $model->personal_scenario = (string) $sheetData[$baseRow]['P'];
                    $model->relationship = (int) $sheetData[$baseRow]['Q'];
                    $model->status = (int) $sheetData[$baseRow]['R'];
                    $model->related_to = (int) $sheetData[$baseRow]['S'];
                    $model->client_type = (string) $sheetData[$baseRow]['T'];
                    $model->client_classification_status = (int) $sheetData[$baseRow]['U'];
                    $model->is_staff_member = (int) $sheetData[$baseRow]['V'];
                    $model->approved_at = time();
                    $model->created_at = time();
                    $model->created_by = Yii::$app->user->id;

                    $model->save();
                    $baseRow++;
                }
                return $this->redirect(['index']);
                Yii::$app->getSession()->setFlash('success', 'Successflly Uploaded');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Error');
            }
        }

        return $this->render('import', [
                    'modelImport' => $modelImport,
        ]);
    }

    /**
     * Deletes an existing Member model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $memb) {
        if (Yii::$app->User->can('Approving Authority')) {
           if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
            $client = $this->findModel($memb);
            $this->findDocumentModel($id)->delete();

            return $this->redirect(['uploaded-documents', 'id' => $client->id]);
        } else {
            return $this->renderContent('You are not permitted to delete this document');
        }
    }

    public function actionDeleteKin($id, $client) {
        if (Yii::$app->User->can('Approving Authority')) {
          if (Yii::$app->member->office_id === 1) {
            $this->layout = "clientprofileadmin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "clientprofilemanager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "clientprofiledirector";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "clientprofileofficer";
        } else {
            $this->layout = "main";
        }
            $client = $this->findModel($client);
            $this->findModel($id)->delete();

            return $this->redirect(['view', 'id' => $client->id]);
        } else {
            return $this->renderContent('You are not permitted to delete this document');
        }
    }

    public function actionPickDocument($id) {
        $document = ClientDocuments::findOne(['id' => $id]);
        return Yii::$app->response->sendFile('/Applications/MAMP/htdocs/elms/frontend/web/html/uploads/' . $document->document, $document->document
        );
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

    protected function findDocumentModel($id) {
        if (($model = ClientDocuments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
