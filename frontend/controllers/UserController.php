<?php

namespace frontend\controllers;

use common\models\rbac\AuthAssignment;
use common\models\rbac\AuthItem;
use common\models\rbac\AuthItemChild;
use common\models\rbac\AuthItemSearch;
use common\models\User;
use common\models\UserSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\rbac\DbManager;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['download'],
                'rules' => [
                    [
                        'actions' => ['download', 'view', 'delete', 'upate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main";
        $loggedIn = Yii::$app->member;
        $searchModel = new UserSearch();
        $searchModel->app_module = 2;
        $searchModel->client_id = $loggedIn->client_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTenants()
    {
        $this->layout = "main";
        $loggedIn = Yii::$app->member;
        $searchModel = new UserSearch();
        $searchModel->app_module = 2;
        $searchModel->client_id = $loggedIn->client_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tenants', [
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
    public function actionView($id)
    {
        $this->layout = "main";
        return $this->render('view', [
            'model' => $this->findModel($id),
            'userId' => $id,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddNewSystemUser($stat = 1, $admin = 0, $app = 2, $pwst = 0)
    {
        $this->layout = "main";
        $model = new User();
        $auth = new DbManager();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'The account has been created successfully');
            //Send Emails to notify a new user that an account has been created
            Yii::$app->mailer->compose('new-account-created', [
                'name' => $model->firstname,
                'username' => $model->username,
            ])->setFrom('kumusoftcreditscore@gmail.com')
                ->setTo($model->email)
                ->setSubject(strtoupper($model->firstname) . ', YOUR  ACCOUNT  HAS BEEN CREATED')
                ->send();
            //Assign roles
            foreach ($_POST['User']['user_groups'] as $group) {
                $role = $auth->getRole($group);
                //Check if this role is not yet assigned
                if (is_null($auth->getAssignment($group, $model->id))) {
                    $auth->assign($role, $model->id);
                }
            }
            return $this->redirect(['index', 'id' => $model->client_id]);
        } else {
            //Create random password
            $passwd = $model->randomPassword();
            //Save this password to the currrent session
            Yii::$app->session->set('default_password', $passwd);
            $model->created_at = time();
            $model->status = $stat;
            $model->password_status = $pwst;
            $model->is_admin = $admin;
            $model->app_module = $app;
            $model->created_by = Yii::$app->member->id;
            $model->client_id = Yii::$app->member->client_id;
            $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($passwd);
            return $this->render('add-new-system-user', [
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
    public function actionUpdate($id)
    {
        $this->layout = "main";
        $model = $this->findModel($id);
        $auth = new DbManager();
        if (Yii::$app->request->isPost) {
            //Load
            $model->load(Yii::$app->request->post());
            //Try to save
            $model->save(false);
            //Assign roles
            Yii::$app->session->setFlash('success', 'The account has been created successfully');
            //Send Emails to notify a new user that an account has been created
            Yii::$app->mailer->compose('new-account-created', [
                'name' => $model->firstname,
                'username' => $model->username,
            ])->setFrom('kumusoftcreditscore@gmail.com')
                ->setTo($model->email)
                ->setSubject(strtoupper($model->firstname) . ', YOUR  ACCOUNT  HAS BEEN CREATED')
                ->send();
            foreach ($_POST['User']['user_groups'] as $group) {
                $role = $auth->getRole($group);
                //Check if this role is not yet assigned
                if (is_null($auth->getAssignment($group, $id))) {
                    $auth->assign($role, $id);
                }
            }
            Yii::$app->session->setFlash("success", "Account has been successfuly updated");
            return $this->redirect(['index', 'id' => $model->client_id]);
        } else {
            //Create random password
            $passwd = $model->randomPassword();
            //Save this password to the currrent session
            Yii::$app->session->set('default_password', $passwd);
            $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($passwd);
            $model->user_groups = ArrayHelper::getColumn($auth->getRolesByUser($id), 'name');
            return $this->render('update', [
                'model' => $model,
                'userId' => $id,
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
        $this->findPermissionModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeletePermission($id)
    {
        $this->findPermissionModel($id)->delete();

        return $this->redirect(['user-permission']);
    }

    /**
     * User groups/roles
     * @return type
     */
    public function actionUserGroups()
    {
        $this->layout = "main";
        return $this->render('user-groups');
    }

    /**
     * User Permissions
     * @return type
     */
    public function actionUserPermissions()
    {
        $searchModel = new AuthItemSearch();
        $searchModel->type = 2;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('user-permissions', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Member model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActivityLogs($id)
    {
        $this->layout = "main";
        return $this->render('activity-logs', [
            'model' => $this->findModel($id),
            'userId' => $id,
        ]);
    }

    /**
     * Create New User Group
     * @return type
     */
    public function actionNewGroup()
    {
        $this->layout = "main";
        $model = new AuthItem();
        if ($model->load(Yii::$app->request->post())) {
            $auth = Yii::$app->authManager;
            $role = $auth->createRole($model->name);
            $role->description = $model->description;
            $auth->add($role);
            return $this->redirect(['user-groups']);
        } else {

            $model->created_at = time();
            $model->type = 1;

            return $this->render('new-group', ['model' => $model]);
        }
    }

    public function actionNewPermission()
    {
        $this->layout = "main";
        $model = new AuthItem();
        if ($model->load(Yii::$app->request->post())) {
            $auth = Yii::$app->authManager;
            $role = $auth->createRole($model->name);
            $role->description = $model->description;
            $role->type = 2;
            $auth->add($role);
            return $this->redirect(['user-permissions']);
        } else {
            $model->created_at = time();
            $model->type = 2;

            return $this->render('new-permission', ['model' => $model]);
        }
    }

    /**
     * Group Details
     * @param type $id
     * @return type
     */
    public function actionGroupDetails($id)
    {
        $this->layout = "main";
        return $this->render('group-details', ['group' => $id]);
    }

    /**
     * Grant Permissions to a given Group
     * @param string $id
     */
    public function actionGrantPermission($id)
    {
        $this->layout = "main";
        $assignments = new AuthItemChild();
        if (Yii::$app->request->isPost) {
            //Selected Items
            $perms = Yii::$app->request->post('AuthItemChild');
            //Then assign the selected roles
            User::assignGroupPermissions($perms['parent'], $perms['children']);
            //Go back to the group details
            return $this->redirect(Url::to(['group-details', 'id' => $perms['parent']]));
        } else {
            $assignments->parent = $id;
            return $this->render('grant-permission', ['model' => $assignments, 'id' => $id]);
        }
    }

    /**
     * Add a User to a user group(s)
     * @param string $id
     */
    public function actionAssignRole($id)
    {
        $this->layout = "main";
        $assignments = new AuthAssignment();
        if (Yii::$app->request->isPost) {
            //Selected Items
            $perms = Yii::$app->request->post('AuthAssignment');
            //Then assign the selected roles
            User::assignRoles($perms['user_id'], $perms['roles']);
            //Go back to the group details
            return $this->redirect(Url::to(['view', 'id' => $perms['user_id']]));
        } else {
            $assignments->user_id = $id;
            $assignments->created_at = time();
            return $this->render('assign-role', ['model' => $assignments, 'id' => $id]);
        }
    }

    public function actionAddNewRole($id)
    {
        $this->layout = "main";
        $user = $this->findModel($id);
        $model = new AuthAssignment();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $user->id]);
        } else {

            $model->created_at = time();
            $model->user_id = $id;
            return $this->render('add-new-role', [
                'model' => $model,
                'user' => $user,
            ]);
        }
    }

    /**
     * Revoke a permission from a given role
     * @param string $rl The role for which we revoking this permission
     * @param string $id The permission we are revoking
     */
    public function actionRevokePermission($rl, $id)
    {
        User::revokePermission($rl, $id);
        return $this->redirect(Url::to(['group-details', 'id' => $rl]));
    }

    /**
     * Remove a role from a user account
     * @param Int $id
     * @param string $rol
     * @return mixed
     */
    public function actionDeleteMember($id)
    {
        $item = AuthAssignment::findOne($id);

        if ($item->delete()) {
            Yii::$app->session->setFlash('success', 'Member successfully deleted');
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            Yii::$app->session->setFlash('danger', 'Sorry, we could not delete that item');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /**
     * Upload a profile picture
     * @return type
     */
    public function actionUploadPic($id)
    {
        $this->layout = "main";
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
            return $this->redirect(Url::to(['view', 'id' => $id]));
        } else {

            return $this->render('upload-pic', ['model' => $model, 'userId' => $id]);
        }
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

    protected function findAssignmentModel($id)
    {
        if (($model = AuthAssignment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findUserProfile()
    {
        if (($model = User::findLoggedInUser()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested profile does not exist.');
    }

    protected function findPermissionModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
