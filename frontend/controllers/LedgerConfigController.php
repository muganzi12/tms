<?php

namespace frontend\controllers;

use Yii;
use common\models\loan\LedgerTransactionConfig;
use common\models\loan\LedgerTransactionConfigSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Reports;
use common\models\client\LoanProduct;
use common\models\client\ClientMasterData;
use yii\db\Query;

/**
 * LedgerConfigController implements the CRUD actions for LedgerTransactionConfig model.
 */
class LedgerConfigController extends Controller {

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
     * Lists all LedgerTransactionConfig models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LedgerTransactionConfigSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LedgerTransactionConfig model.
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
     * Creates a new LedgerTransactionConfig model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new LedgerTransactionConfig();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        $chartofaccounts = Reports::getChartOfAccounts(false);
        $model->created_at = time();
        $model->created_by = Yii::$app->member->id;
        return $this->render('create', [
                    'model' => $model,
                    'chartofaccounts' => $chartofaccounts
        ]);
    }

    /**
     * Transaction on products
     */
    public function actionAddNewTransaction($id, $mode = 'LOAN') {
        $model = new LedgerTransactionConfig();

        $product = $this->findLoanProductModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['loan-product/view', 'id' => $product->id]);
        }
        $chartofaccounts = Reports::getChartOfAccounts(false);
        $label = ClientMasterData::findAll(['reference_table' => 'loan_config_label']);
        $model->created_at = time();
        $model->created_by = Yii::$app->member->id;
        $model->product_type = $mode;
        $model->product_id = $id;
        return $this->render('add-new-transaction', [
                    'model' => $model,
                    'product' => $product,
                    'chartofaccounts' => $chartofaccounts,
                     'label'=>$label
        ]);
    }

    /**
     * Products (Loan, Investment) which can be configured
     */
    public function actionProducts() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $productType = $parents[0];

                switch ($productType) {
                    case 'LOAN':
                        $out = Yii::$app->db->createCommand("select id, name from loan_product")->queryAll();
                        break;
                    case 'INVESTMENT':
                        $out = [];
                        break;
                    case 'ADMIN':
                    default:
                        $out = [];
                        break;
                }

                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    /**
     * Updates an existing LedgerTransactionConfig model.
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
        $chartofaccounts = Reports::getChartOfAccounts(false);
        $model->updated_at = time();
        $model->updated_by = Yii::$app->member->id;
        return $this->render('create', [
                    'model' => $model,
                    'chartofaccounts' => $chartofaccounts
        ]);
    }

    /**
     * Deletes an existing LedgerTransactionConfig model.
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
     * Finds the LedgerTransactionConfig model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LedgerTransactionConfig the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = LedgerTransactionConfig::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Loan Product Model
     */
    protected function findLoanProductModel($id) {
        if (($model = LoanProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
