<?php

namespace app\controllers;

use app\models\JobCard;
use app\models\JobCardItems;
use app\models\JobCardItemsSearch;
use app\models\Users;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * JobCardItemsController implements the CRUD actions for JobCardItems model.
 */
class JobCardItemsController extends Controller {

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
     * Lists all JobCardItems models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new JobCardItemsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JobCardItems model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new JobCardItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($job_card_id) {
        $model = new JobCardItems();

        $model->status = JobCard::STATUS_UNDER_REPAIR;
        $model->current_location = JobCard::LOCATION_BRANCH;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->job_card_id = $job_card_id;
                if ($model->save()) {
                    return $this->redirect(['job-card/view', 'id' => $job_card_id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing JobCardItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {


            if ($model->save()) {


                $user = Users::findOne(["id" => Yii::$app->user->id]);




                if (Users::isServiceRole()) {

                    return $this->redirect(['indexinstock']);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

//        return $this->render('update', [
//                    'model' => $model,
//        ]);

        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing JobCardItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JobCardItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return JobCardItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = JobCardItems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionIndexready() {
        $searchModel = new JobCardItemsSearch();
        $dataProvider = $searchModel->readysearch($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTransfer() {
        $searchModel = new JobCardItemsSearch();
        $dataProvider = $searchModel->transfersearch($this->request->queryParams);

        return $this->render('transfer', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRecieve() {
        $searchModel = new JobCardItemsSearch();
        $dataProvider = $searchModel->recievesearch($this->request->queryParams);

        return $this->render('recieve', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexinstock() {
        $searchModel = new JobCardItemsSearch();
        $dataProvider = $searchModel->needfixsearch($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

}
