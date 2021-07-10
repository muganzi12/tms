<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\ApiRequestHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all Users.
     * @return mixed
     */
     public function actionIndex($id) {
        $api = new ApiRequestHelper('sacco');
        $records = $api->makeGet('all-users/'.$id);
        return $this->render('index', ['user' =>$records]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
      public function actionView($id) {
        $api = new ApiRequestHelper('sacco');
        $response = $api->makeGet('details/' . $id);

        return $this->render('view', [
                    'model' => $response,
        ]);
    }
  
      /**
     * Register a new System User
     */
    public function actionNewUser() {
        $model = new User();
        $api = new ApiRequestHelper('sacco');
        if ($model->load(Yii::$app->request->post())) {
            $api->makePost('register-user', ['user' => $model->attributes]);
            Yii::$app->session->setFlash('success', 'Account successfully created');
            return $this->redirect(['index','id' => Yii::$app->member->sacco_id]);
        }
        else{
            $pass ="Robin@123";
            $model->created_at = time();
            $model->status=10;
            $model->sacco_id = Yii::$app->member->sacco_id;
            $model->app_module = 2;
            $model->password_status = 0;
            $model->account_type = "sacco";
            $model->created_by = Yii::$app->member->id;
            $model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($pass);
            return $this->render('new-user', [
                        'model' => $model,
            ]);
        }
    }
    
    
    
    //Update User Details
    
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $api = new ApiRequestHelper('sacco');
        if ($model->load(Yii::$app->request->post())) {
            $response = $api->makePatch('update-user', ['user' => $model->attributes]);
              Yii::$app->session->setFlash('success', 'Account Details successfully updated');
             return $this->redirect(['index','id' => Yii::$app->member->sacco_id]);
        } else {
            $pass ="Robin@123";
            $model->updated_at = time();
            $model->status=10;
            $model->sacco_id = Yii::$app->member->sacco_id;
            $model->app_module = 2;
            $model->password_status = 0;
            $model->account_type = "sacco";
            $model->updated_by = Yii::$app->member->id;
            $model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($pass);
            return $this->render('update', [
                        'model' => $model
            ]);
        }
    }


    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
