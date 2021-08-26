<?php

namespace frontend\controllers;

use Yii;
use common\models\client\Investor;
use common\models\client\InvestorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\client\MasterData;
use common\models\client\Investment;
use common\models\client\InvestmentSearch;
use yii\web\UploadedFile;

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
        $searchModel = new InvestorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInvestments($id) {
        $this->layout = "investorprofile";
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
    public function actionView($id) {
        $this->layout = "investorprofile";
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
        $model = new Investor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $ident = MasterData::findAll(['reference_table' => 'identification_type']);
            $sex = MasterData::findAll(['reference_table' => 'sex']);
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->status = $stat;
            return $this->render('add-new-investor', [
                        'model' => $model,
                        'ident' => $ident,
                        'sex' => $sex,
            ]);
        }
    }

    public function actionAddNewInvestment($id) {
        $this->layout = "investorprofile";
        $model = new Investment();
        $investment = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['investments', 'id' => $investment->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->investor_id = $id;
            return $this->render('add-new-investment', [
                        'model' => $model,
                        'investment' => $investment,
                        'investorId' => $id,
            ]);
        }
    }

    //Upload Passport Picture
    public function actionUploadPhoto($id) {
        $this->layout = "investorprofile";
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
        $this->layout = "investorprofile";
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $ident = MasterData::findAll(['reference_table' => 'identification_type']);
            $model->updated_at = time();
            $model->updated_by = Yii::$app->member->id;
            return $this->render('update', [
                        'model' => $model,
                        'ident' => $ident,
                        'investorId' => $id
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

}
