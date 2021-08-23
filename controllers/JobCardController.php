<?php

namespace app\controllers;

use app\models\JobCard;
use app\models\JobCardDetailsModel;
use app\models\JobCardItemsSearch;
use app\models\JobCardSearch;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * JobCardController implements the CRUD actions for JobCard model.
 */
class JobCardController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return array_merge(
                parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
                ]
        );
    }

    /**
     * Lists all JobCard models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new JobCardSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexready() {
        $searchModel = new JobCardSearch();
        $dataProvider = $searchModel->readysearch($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTransfer() {
        $searchModel = new JobCardSearch();
        $dataProvider = $searchModel->needfixsearch($this->request->queryParams);

        return $this->render('transfer', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JobCard model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {

        $searchModel = new JobCardItemsSearch();
        $dataProvider = $searchModel->mysearch($this->request->queryParams, $id);

        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new JobCard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new JobCard();




        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing JobCard model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JobCard model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);

        try {
            $model->delete();
        } catch (Exception $ex) {
            Yii::$app->session->setFlash('error', "Job Card has items cannot delete");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the JobCard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return JobCard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = JobCard::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionJobCardDetail() {

        $model = new JobCardDetailsModel();

        if ($model->load($this->request->post())) {
//            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('job-card-details', [
                    'model' => $model
        ]);
    }

}
