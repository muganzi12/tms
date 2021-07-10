<?php

namespace frontend\controllers;

use Yii;
use common\models\member\Member;
use common\models\member\NextOfKin;
use common\models\ApiRequestHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
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
        $records = $api->makeGet('all-members/'.$id);
        return $this->render('index', ['member' =>$records]);
    }
    
    
       /**
     * Lists all Next of Kins.
     * @return mixed
     */
     public function actionNextOfKinList() {
        $api = new ApiRequestHelper('sacco');
        $records = $api->makeGet('all-next-of-kins');
        return $this->render('next-of-kin-list', ['kin' =>$records]);
    }
    

    /**
     * Displays a single Member model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
      public function actionView($id) {
        $api = new ApiRequestHelper('sacco');
        $response = $api->makeGet('member-details/' . $id);

        return $this->render('view', [
                    'model' => $response,
        ]);
    }

        /**
     * Register a new Member
     */
    public function actionNewMember() {
        $model = new Member();
        $api = new ApiRequestHelper('sacco');
        if ($model->load(Yii::$app->request->post())) {
            $api->makePost('new-member', ['member' => $model->attributes]);
            Yii::$app->session->setFlash('success', 'Member successfully Saved');
            return $this->redirect(['index','id' => Yii::$app->member->sacco_id]);
        }
        else{
            $model->created_at = time();
            $model->status=0;
            $model->sacco_id = Yii::$app->member->sacco_id;
            $model->member_id_number = $model->generateReferenceNumber();
            $model->created_by = Yii::$app->member->id;
            return $this->render('new-member', [
                        'model' => $model,
            ]);
        }
    }
    
           /**
     * Register a new Member
     */
    public function actionNewNextOfKin() {
        $model = new NextOfKin();
        $api = new ApiRequestHelper('sacco');
        if ($model->load(Yii::$app->request->post())) {
            $api->makePost('new-next-of-kin', ['kin' => $model->attributes]);
            Yii::$app->session->setFlash('success', 'Next of Kin successfully Saved');
            return $this->redirect(['next-of-kin-list','id' => Yii::$app->member->sacco_id]);
        }
        else{
            $model->created_at = time();
            $model->member_id = Yii::$app->member->id;
            $model->created_by = Yii::$app->member->id;
            return $this->render('new-next-of-kin', [
                        'model' => $model,
            ]);
        }
    }

   //Update User Details
    
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $api = new ApiRequestHelper('sacco');
        if ($model->load(Yii::$app->request->post())) {
         $api->makePatch('update-member', ['member' => $model->attributes]);
              Yii::$app->session->setFlash('success', 'Member Details successfully updated');
             return $this->redirect(['index','id' => Yii::$app->member->sacco_id]);
        } else {
            $model->updated_at = time();
            $model->status=0;
            $model->sacco_id = Yii::$app->member->sacco_id;
            $model->member_id_number = $model->generateReferenceNumber();
            $model->updated_by = Yii::$app->member->id;
            return $this->render('update', [
                        'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing Member model.
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
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
