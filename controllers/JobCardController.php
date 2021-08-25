<?php

namespace app\controllers;

use app\models\JobCard;
use app\models\JobCardItems;
use app\models\JobCardItemsSearch;
use app\models\JobCardSearch;
use app\models\Users;
use Yii;
use yii\bootstrap\Alert;
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
                parent::behaviors(),
                [
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

    public function actionIndexinstock() {
        $searchModel = new JobCardSearch();
        $dataProvider = $searchModel->needfixsearch($this->request->queryParams);

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

    public function actionRecieve() {
        $searchModel = new JobCardSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('recieve', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView2($id) {

        $searchModel = new JobCardItemsSearch();

        $dataProvider = $searchModel->mysearch2($this->request->queryParams, $id);

        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
        //hhhhhhhh
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
        $user = Users::findOne(["id" => Yii::$app->user->id]);



        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (Users::isBranchRole()) {

                    $branchid = $user->branch;

                    $model->branch_id = $branchid;
                    $model->current_location = JobCard::LOCATION_BRANCH;
                }
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
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

    public function actionSendToCenter($id) {


        $item = JobCardItems::findOne(['id' => $id]);

        if ($item) {
            $item->current_location = JobCard::LOCATION_SENT_TO_SERVICE;
            $item->update();
            if ($item->save()) {

                $jobcarditem = JobCardItems::find()
                        ->where(['job_card_id' => $item->job_card_id])
                        ->andWhere(['current_location' => JobCard::LOCATION_BRANCH])
                        ->all();


                if (!$jobcarditem) {
                    $jobcard = JobCard::findOne(['id' => $item->job_card_id]);
                    $jobcard->current_location = JobCard::LOCATION_SENT_TO_SERVICE;
                    if ($jobcard->save()) {
                        return $this->redirect(['job-card/index']);
                    }
                }
                return $this->redirect(['job-card/view', 'id' => $item->job_card_id]);
            }
        }
    }

    public function actionSendToBranch($id) {

        $item = JobCardItems::findOne(['id' => $id]);


        if ($item) {

            if ($item->status == JobCard::STATUS_UNDER_REPAIR) {
                return "items still under repair";
            } else {
                $item->current_location = JobCard::LOCATION_SENT_TO_BRANCH;
                $item->update();
                $item->save();
                $jobcarditem = JobCardItems::find()
                        ->where(['job_card_id' => $item->job_card_id])
                        ->andWhere(['current_location' => JobCard::LOCATION_SERVICE])
                        ->all();


                if (!$jobcarditem) {
                    $jobcard = JobCard::findOne(['id' => $item->job_card_id]);
                    $jobcard->current_location = JobCard::LOCATION_SENT_TO_BRANCH;
                    if ($jobcard->save()) {
                        return $this->redirect(['job-card/index']);
                    }
                }
                return $this->redirect(['job-card/view', 'id' => $item->job_card_id]);
            }
        }
    }

    public function actionRecieveFromBranch($id) {

        $item = JobCardItems::findOne(['id' => $id]);


        if ($item) {


            $item->current_location = JobCard::LOCATION_SERVICE;
            $item->update();
            $item->save();
            $jobcarditem = JobCardItems::find()
                    ->where(['job_card_id' => $item->job_card_id])
                    ->andWhere(['current_location' => JobCard::LOCATION_SENT_TO_SERVICE])
                    ->all();


            if (!$jobcarditem) {
                $jobcard = JobCard::findOne(['id' => $item->job_card_id]);
                $jobcard->current_location = JobCard::LOCATION_SERVICE;
                if ($jobcard->save()) {
                    return $this->redirect(['job-card/index']);
                }
            }
            return $this->redirect(['job-card/view2', 'id' => $item->job_card_id]);
        }
    }

    public function actionRecieveFromService($id) {

        $item = JobCardItems::findOne(['id' => $id]);


        if ($item) {


            $item->current_location = JobCard::LOCATION_BRANCH;
            $item->update();
            $item->save();
            $jobcarditem = JobCardItems::find()
                    ->where(['job_card_id' => $item->job_card_id])
                    ->andWhere(['current_location' => JobCard::LOCATION_SENT_TO_BRANCH])
                    ->all();


            if (!$jobcarditem) {
                $jobcard = JobCard::findOne(['id' => $item->job_card_id]);
                $jobcard->current_location = JobCard::LOCATION_BRANCH;
                if ($jobcard->save()) {
                    return $this->redirect(['job-card/index']);
                }
            }
            return $this->redirect(['job-card/view2', 'id' => $item->job_card_id]);
        }
    }

}
