<?php

namespace frontend\controllers;

use Yii;
use common\models\client\LoanProduct;
use common\models\client\LoanProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\client\ClientMasterData;
use common\models\client\LoanProductRequiredDocuments;
use common\models\client\LoanProductRequiredDocumentsSearch;
use yii\helpers\Json;
/**
 * LoanProductController implements the CRUD actions for LoanProduct model.
 */
class LoanProductController extends Controller {

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
     * Lists all LoanProduct models.
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
        $searchModel = new LoanProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

// Get Required Document for the specific Loan Product
    public function actionRequiredDocuments($id) {
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
        $searchModel = new LoanProductRequiredDocumentsSearch();
        $searchModel->loan_product_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('required-documents', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'client' => $client,
        ]);
    }

    /**
     * Displays a single LoanProduct model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
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
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Add a New Loan Product.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddNewLoanProduct($stat = 1) {
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
        $model = new LoanProduct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['specify-document-required', 'id' => $model->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->status = $stat;
            $currency = ClientMasterData::findAll(['reference_table' => 'currency']);
            return $this->render('add-new-loan-product', [
                        'model' => $model,
                        'currency' => $currency,
            ]);
        }
    }

    // Specify the required documents
    public function actionSpecifyDocumentRequired($id) {
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
        $model = new LoanProductRequiredDocuments();
        $client = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['loan-product/view', 'id' => $client->id]);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->loan_product_id = $id;
            return $this->render('specify-document-required', [
                        'model' => $model,
                        'client' => $client,
            ]);
        }
    }

    // Get Loan Product
    public function actionGetInterestRate($prodId) {
        // find the loan product id from the loan_product table 
        $location = LoanProduct::findOne($prodId);
        echo Json::encode($location);
    }
    
    // Get Loan Product
//    public function actionGetInterestRate($prodId) {
//        // find the loan product id from the loan_product table 
//        $location = LoanProduct::findOne($prodId);
//        return Json::encode($location);
//    }

    /**
     * Updates an existing LoanProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            $model->updated_at = time();
            $model->updated_by = Yii::$app->member->id;
            $currency = ClientMasterData::findAll(['reference_table' => 'currency']);
            return $this->render('update', [
                        'model' => $model,
                        'currency' => $currency,
            ]);
        }
    }

    /**
     * Deletes an existing LoanProduct model.
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
     * Finds the LoanProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LoanProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = LoanProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
