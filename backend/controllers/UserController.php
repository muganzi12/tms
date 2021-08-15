<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\masterdata\Company;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex($id) {
        $inst = $this->findInstitutionModel($id);
        $searchModel = new UserSearch();
        $searchModel->is_admin = 1;
        $searchModel->client_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'inst' => $inst,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    //Super Admin
     public function actionSuperAdmin() {
        $searchModel = new UserSearch();
        $searchModel->app_module = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('super-admin', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    
    //Super Admin
     public function actionClientAdmin() {
        $searchModel = new UserSearch();
        $searchModel->app_module = 2;
        $searchModel->is_admin = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('client-admin', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Register a new Client System Admin
     */
    public function actionNewAdmin($id, $stat = 1, $admin = 1, $app = 2, $pwst = 0) {
        $model = new User();
        $inst = $this->findInstitutionModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'The account has been created successfully');
            //Send Emails to notify a new user that an account has been created
            Yii::$app->mailer->compose('new-account-created', [
                        'name' => $model->firstname,
                        'username' => $model->username
                    ])->setFrom('kumusoftcreditscore@gmail.com')
                    ->setTo($model->email)
                    ->setSubject(strtoupper($model->firstname) . ', YOUR ADMIN ACCOUNT IS HAS BEEN CREATED')
                    ->send();
            return $this->redirect(['index', 'id' => $inst->id]);
        } else {
            //Create random password
            $passwd = $model->randomPassword();
            //Save this password to the currrent session
            Yii::$app->session->set('default_password', $passwd);
            $model->created_at = time();
            $model->status = $stat;
            $model->client_id = $id;
            $model->password_status = $pwst;
            $model->is_admin = $admin;
            $model->app_module = $app;
            $model->created_by = Yii::$app->member->id;
            $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($passwd);
            return $this->render('new-admin', [
                        'model' => $model,
                        'inst' => $inst,
            ]);
        }
    }

        /**
     * Register a new System User
     */
    public function actionAddNewSuperAdmin($stat = 1, $admin = 1, $app = 1,$client=0, $pwst = 0) {
        $model = new User();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'The account has been created successfully');
            //Send Emails to notify a new user that an account has been created
            Yii::$app->mailer->compose('new-account-created', [
                        'name' => $model->firstname,
                        'username' => $model->username
                    ])->setFrom('kumusoftcreditscore@gmail.com')
                    ->setTo($model->email)
                    ->setSubject(strtoupper($model->firstname) . ', YOUR ADMIN ACCOUNT IS HAS BEEN CREATED')
                    ->send();
            return $this->redirect(['super-admin']);
        } else {
            //Create random password
            $passwd = $model->randomPassword();
            //Save this password to the currrent session
            Yii::$app->session->set('default_password', $passwd);
            $model->created_at = time();
            $model->status = $stat;
            $model->client_id = $client;
            $model->password_status = $pwst;
            $model->is_admin = $admin;
            $model->app_module = $app;
            $model->created_by = Yii::$app->member->id;
            $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($passwd);
            return $this->render('add-new-super-admin', [
                        'model' => $model,
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
    public function actionUpdateAdmin($id) {
        $model = $this->findModel($id);
        $inst = $this->findInstitutionModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update-admin', [
                    'model' => $model,
                    'inst' => $inst,
        ]);
    }
    
    
      public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['super-admin']);
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
    public function actionDelete($id) {
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
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findInstitutionModel($id) {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
