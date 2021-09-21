<?php

namespace frontend\controllers;

use Yii;
use common\models\client\ChartOfAccounts;
use common\models\client\ChartOfAccountsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\client\MasterData;
use common\models\Reports;
/**
 * AccountController implements the CRUD actions for ChartOfAccounts model.
 */
class AccountController extends Controller {

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
     * Lists all ChartOfAccounts models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ChartOfAccountsSearch();
        $searchModel->category = 'HEADER';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $chartofaccounts=Reports::getChartOfAccounts();
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'chart'=>$chartofaccounts
        ]);
    }

    public function actionAccounts($id) {
        $account = $this->findAccountModel($id);
        $searchModel = new ChartOfAccountsSearch();
        $searchModel->parent_id = $id;
         $searchModel->category = 'DETAIL';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('accounts', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'account' => $account,
        ]);
    }

    /**
     * Displays a single ChartOfAccounts model.
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
     * Creates a new ChartOfAccounts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddNewAccount($cat = 'DETAIL') {
        $model = new ChartOfAccounts();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $model->created_at = time();
            $model->category = $cat;
            $model->created_by = Yii::$app->member->id;
            $chartofaccounts=Reports::getChartOfAccounts(false);
        
            //Add None
            $no_option = new ChartOfAccounts();
            $no_option->id=0;
            $no_option->account_name="NONE";

            array_unshift($chartofaccounts,$no_option);
            $type = MasterData::findAll(['reference_table' => 'account_type']);
            return $this->render('add-new-account', [
                        'model' => $model,
                        'type' => $type,
                        'chartofaccounts'=>$chartofaccounts
            ]);
        }
    }

    /**
     * Updates an existing ChartOfAccounts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        $type = MasterData::findAll(['reference_table' => 'account_type']);
        $chartofaccounts=Reports::getChartOfAccounts(false);
            
        return $this->render('update', [
                    'model' => $model,
                    'type'=>$type,
                    'chartofaccounts'=>$chartofaccounts
        ]);
    }

    /**
     * Deletes an existing ChartOfAccounts model.
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
     * Finds the ChartOfAccounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChartOfAccounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ChartOfAccounts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findAccountModel($id) {
        if (($model = ChartOfAccounts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
