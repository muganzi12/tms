<?php

namespace frontend\controllers;

use common\models\collection\Payment;
use common\models\property\PropertyUnit;
use common\models\property\PropertyUnitSearch;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PropertyUnitController implements the CRUD actions for PropertyUnit model.
 */
class PropertyUnitController extends Controller
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
     * Lists all PropertyUnit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PropertyUnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PropertyUnit model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PropertyUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddNewPropertyUnit()
    {
        $model = new PropertyUnit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->status = User::STATUS_ACTIVE;
            return $this->render('add-new-property-unit', [
                'model' => $model,
            ]);
        }
    }

    //Make Payment
    public function actionMakePayment($id, $status = 2)
    {
        $model = new Payment();
        $property = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Yii::$app->db->createCommand('UPDATE property SET status = 36 WHERE id =' . $id)->execute();
            //Go back tolist of propertys
            Yii::$app->session->setFlash('success', 'You have successfully made a payment');
            return $this->redirect(['property-unit/index']);
        } else {
            $model->created_at = time();
            $model->created_by = Yii::$app->member->id;
            $model->property_unit = $id;
            $model->property = $property->property;
            $model->status = $status;
            return $this->render('make-payment', [
                'model' => $model,
                'property' => $property,
                'propertyId' => $id,
            ]);
        }
    }

    /**
     * Updates an existing PropertyUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {

            $model->updated_at = time();
            $model->updated_by = Yii::$app->member->id;

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PropertyUnit model.
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
     * Finds the PropertyUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PropertyUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PropertyUnit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
