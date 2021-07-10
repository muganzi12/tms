<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\ApiRequestHelper;
use common\models\MasterData;
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
     * Lists all User models.
     * @return mixed
     */
     public function actionIndex() {
        $api = new ApiRequestHelper('admin');
        $records = $api->makeGet('all-users');
        return $this->render('index', ['user' =>$records]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $api = new ApiRequestHelper('admin');
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
        $api = new ApiRequestHelper('admin');
        if ($model->load(Yii::$app->request->post())) {
            $api->makePost('register-user', ['user' => $model->attributes]);
            Yii::$app->session->setFlash('success', 'Account successfully created');
            return $this->redirect(['index','id' => Yii::$app->member->sacco_id]);
        }
        else{
            $pass ="Robin@123";
            $model->created_at = time();
            $model->status=10;
            $model->app_module = 2;
            $model->password_status = 0;
            $model->branch_id = 0;
            $model->sacco_id = 0;
            $model->office_id = 0;
            $model->account_type = "admin";
            $model->created_by = Yii::$app->member->id;
            $model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($pass);
               //Dropdowns
            $modules = MasterData::findAll(['reference_table' => 'app_module']);
            return $this->render('new-user', [
                        'model' => $model,
                        'modules'=>$modules
            ]);
        }
    }

    /**
     * Updates an existing User model.
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
