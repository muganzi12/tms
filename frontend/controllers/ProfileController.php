<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\ApiRequestHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\rbac\DbManager;
use common\models\MasterData;

/**
 * Site controller
 */
class ProfileController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'new-picture', 'permissions'],
                'rules' => [[
                // 'actions' => ['logout', 'index'],
                'allow' => true,
                'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Profile information for the logged in User
     * @return mixed
     */
    public function actionIndex($id) {
        if (Yii::$app->member->office_id === 1) {
            $this->layout = "userprofile_admin";
        } elseif (Yii::$app->member->office_id === 2) {
            $this->layout = "userprofile_manager";
        } elseif (Yii::$app->member->office_id === 3) {
            $this->layout = "userprofile_director";
        } elseif (Yii::$app->member->office_id === 4) {
            $this->layout = "userprofile_officer";
        } else {
            $this->layout = "main";
        }
        $auth = new DbManager();
        $myperm = $auth->getPermissionsByUser(Yii::$app->member->id);
        return $this->render('index', ['permissions' => $myperm, 'userId' => $id]);
    }

    /**
     * Profile information for the logged in User
     * @return mixed
     */
    public function actionPermissions() {
        // $this->layout = "memberprofile";
        $auth = new DbManager();
        $myperm = $auth->getPermissionsByUser(Yii::$app->member->id);
        return $this->render('permissions', ['permissions' => $myperm]);
    }

    /**
     * Update own profile
     */
    public function actionEdit($stat = 10, $admin = 1, $app = 2) {
        $model = User::findLoggedInUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //Go back to the profile
            return $this->redirect(Url::to(['profile/index', 'id' => Yii::$app->member->id]));
        } else {
            $pass = "Robin@123";
            $model->created_at = time();
            $model->status = $stat;
            $model->institution_id = Yii::$app->member->institution_id;
            $model->is_admin = $admin;
            $model->app_module = $app;
            $model->created_by = Yii::$app->member->id;
            $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($pass);
            return $this->render('edit', ['model' => Yii::$app->member]);
        }
    }

    /**
     * Upload a profile picture
     * @return type
     */
    public function actionUploadPic() {
        $model = $this->findUserProfile();
        if (Yii::$app->request->isPost) {
            // $id = $posted['User']['id'];

            $pic = UploadedFile::getInstanceByName('User[profile_pic]');

            //try to upload

            $filename = $model->username . '_pic.' . $pic->extension;
            $dir = Yii::getAlias('@dir_htmlassets');
            //Try to save
            $pic->saveAs($dir . "/profile-pics/" . $filename);
            //Update member details
            $model->profile_pic = $filename;
            $model->save(false);
            //Go back
            return $this->redirect(Url::home());
        } else {

            return $this->render('upload-pic', ['model' => $model]);
        }
    }

    /**
     * Upload a profile picture
     * @return type
     */
    public function actionUploadSignature() {
        $this->layout = "main_change_password";
        $model = $this->findUserProfile();
        if (Yii::$app->request->isPost) {
            // $id = $posted['User']['id'];

            $sign = UploadedFile::getInstanceByName('User[signature]');
            //try to upload
            $filename = $model->username . '_sign.' . $sign->extension;
            $dir = Yii::getAlias('@dir_htmlassets');
            //Try to save
            $sign->saveAs($dir . "/signature-pics/" . $filename);
            //Update member details
            $model->signature = $filename;
            $model->save(false);
            //Go back
            return $this->redirect(Url::home());
        } else {
            return $this->render('upload-signature', ['model' => $model]);
        }
    }

    /**
     * Upload a profile picture
     * @return type
     */
    public function actionChangeSignature() {
        $model = $this->findUserProfile();
        if (Yii::$app->request->isPost) {
            // $id = $posted['User']['id'];

            $sign = UploadedFile::getInstanceByName('User[signature]');
            //try to upload
            $filename = $model->username . '_sign.' . $sign->extension;
            $dir = Yii::getAlias('@dir_htmlassets');
            //Try to save
            $sign->saveAs($dir . "/signature-pics/" . $filename);
            //Update member details
            $model->signature = $filename;
            $model->save(false);
            //Go back
            return $this->redirect(Url::home());
        } else {
            return $this->render('change-signature', ['model' => $model]);
        }
    }

    protected function findUserProfile() {
        if (($model = User::findLoggedInUser()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested profile does not exist.');
    }

}
