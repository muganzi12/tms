<?php

namespace frontend\controllers;

use Yii;
use common\models\sacco\Sacco;
use common\models\sacco\Branch;
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
     * Lists all Members.
     * @return mixed
     */
     public function actionIndex($id) {
        $api = new ApiRequestHelper('sacco');
        $records = $api->makeGet('all-branches/'.$id);
        return $this->render('index', ['branch' =>$records]);
    }

    /**
     * Displays a single Sacco model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $api = new ApiRequestHelper('sacco');
        $records = $api->makeGet('branch-details/'.$id);
         return $this->render('view', ['branch' =>$records]);
    }

    /**
     * Register New BRANCH.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNewBranch() {
        $model = new Branch();
        $api = new ApiRequestHelper('sacco');
        if ($model->load(Yii::$app->request->post())) {
            $api->makePost('register-user', ['branch' => $model->attributes]);
            Yii::$app->session->setFlash('success', 'Account successfully created');
            return $this->redirect(['index','id' => Yii::$app->member->sacco_id]);
        }
        else{
            $model->created_at = time();
            $model->sacco_id = Yii::$app->member->sacco_id;
            $model->created_by = Yii::$app->member->id;
            return $this->render('new-branch', [
                        'model' => $model,
            ]);
        }
    }

    //Update Branch Details
    
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $api = new ApiRequestHelper('sacco');
        if ($model->load(Yii::$app->request->post())) {
          $api->makePatch('update-branch', ['branch' => $model->attributes]);
              Yii::$app->session->setFlash('success', 'Branch Details successfully updated');
             return $this->redirect(['index','id' => Yii::$app->member->sacco_id]);
        } else {
            $model->updated_at = time();
            $model->sacco_id = Yii::$app->member->sacco_id;
            $model->updated_by = Yii::$app->member->id;
            return $this->render('update', [
                        'model' => $model
            ]);
        }
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
        if (($model = Branch::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
}
