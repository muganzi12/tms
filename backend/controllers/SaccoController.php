<?php

namespace backend\controllers;

use Yii;
use common\models\sacco\Sacco;
use common\models\ApiRequestHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SaccoController implements the CRUD actions for Sacco model.
 */
class SaccoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all SACCOs.
     * @return mixed
     */
     public function actionIndex() {
        $api = new ApiRequestHelper('admin');
        $records = $api->makeGet('all-saccos');
        return $this->render('index', ['sacco' =>$records]);
    }

    /**
     * Displays a single Sacco model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionView($id)
    {
        $api = new ApiRequestHelper('admin');
        $records = $api->makeGet('sacco-details/'.$id);
         return $this->render('view', ['sacco' =>$records]);
    }

    /**
     * Creates a new Sacco model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNewSacco() {
        $model = new Sacco();
        $api = new ApiRequestHelper('admin');
        if ($model->load(Yii::$app->request->post())) {
            $api->makePost('register-sacco', ['sacco' => $model->attributes]);
            Yii::$app->session->setFlash('success', 'SACCO successfully created');
            return $this->redirect(['index']);
        }
        else{
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            return $this->render('new-sacco', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sacco model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sacco model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sacco model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sacco the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sacco::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
