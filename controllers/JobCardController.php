<?php

namespace app\controllers;

use app\models\Branch;
use app\models\Customer;
use app\models\Item;
use app\models\JobCard;
use app\models\JobCardDetailsModel;
use app\models\JobCardItems;
use app\models\JobCardItemsSearch;
use app\models\JobCardSearch;
use app\models\Status;
use app\models\Users;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * JobCardController implements the CRUD actions for JobCard model.
 */
class JobCardController extends Controller {

    public static function allowedDomains() {
        return [
            '*', // star allows all domains
//            'https://sendgrid.api-docs.io',
        ];
    }

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

//                $jobcarditem = JobCardItems::find()
//                        ->where(['job_card_id' => $item->job_card_id])
//                        ->andWhere(['current_location' => JobCard::LOCATION_BRANCH])
//                        ->all();
//
//
//                if (!$jobcarditem) {
//                    $jobcard = JobCard::findOne(['id' => $item->job_card_id]);
//                    $jobcard->current_location = JobCard::LOCATION_SENT_TO_SERVICE;
//                    if ($jobcard->save()) {
//                        return $this->redirect(['job-card/index']);
//                    }
//                }
//                return $this->redirect(['job-card/view', 'id' => $item->job_card_id]);
                return $this->redirect(['job-card-items/transfer']);
            }
        }
    }

    public function actionSendToBranch($id) {

        $item = JobCardItems::findOne(['id' => $id]);


        if ($item) {

            if ($item->status == JobCard::STATUS_UNDER_REPAIR) {

                return [
                    "success" => false,
                    "message" => "The item status still under repair, Update item status before sending it"
                ];
            } else {
                $item->current_location = JobCard::LOCATION_SENT_TO_BRANCH;
                $item->update();
                $item->save();
//                $jobcarditem = JobCardItems::find()
//                        ->where(['job_card_id' => $item->job_card_id])
//                        ->andWhere(['current_location' => JobCard::LOCATION_SERVICE])
//                        ->all();
//
//
//                if (!$jobcarditem) {
//                    $jobcard = JobCard::findOne(['id' => $item->job_card_id]);
//                    $jobcard->current_location = JobCard::LOCATION_SENT_TO_BRANCH;
//                    if ($jobcard->save()) {
//                        return $this->redirect(['job-card/index']);
//                    }
//                }
//                return $this->redirect(['job-card/view', 'id' => $item->job_card_id]);
                return $this->redirect(['job-card-items/transfer']);
            }
        }
    }

    public function actionRecieveFromBranch() {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $post = $request->post();
        $id = $post["id"];

        $item = JobCardItems::findOne(['id' => $id]);


        if ($item) {

            $items = Item::findOne(['id' => $item->item_id]);
            $itemName = $items['name'];
            $status = Status::findOne(['id' => $item->status]);
            $statusName = $status['name'];
            $jobcard = JobCard::findOne(["id" => $item->job_card_id]);
            $customer = Customer::findOne(['id' => $jobcard->customer_id]);

            $location = Branch::findOne(["id" => $jobcard->branch_id]);
            $locationName = $location->name;


            $message = "Hello " . $customer->name . "\r\nYour item : " . $itemName . "\r\nJob Card nb:  " . $item['job_card_id'] . "\r\nIs recieved By G4L Service Center";

//            return [
//                "success" => true,
//                "message" => "successfully recieved item from service center"
//            ];
//            $message = Yii::$app->twilio->sms($customer->phone, $message, ['from' => '+16503185356']);
            $message = Yii::$app->twilio->sms($customer->phone, $message, ['from' => '+13302720108']);

            $item->current_location = JobCard::LOCATION_SERVICE;
            $item->update();
            $item->save();

            return [
                "success" => true,
                "message" => "successfully recieved item from branch"
            ];

//            $jobcarditem = JobCardItems::find()
//                    ->where(['job_card_id' => $item->job_card_id])
//                    ->andWhere(['current_location' => JobCard::LOCATION_SENT_TO_SERVICE])
//                    ->all();
//
//
//            if (!$jobcarditem) {
//                $jobcard = JobCard::findOne(['id' => $item->job_card_id]);
//                $jobcard->current_location = JobCard::LOCATION_SERVICE;
//                if ($jobcard->save()) {
//                    return $this->redirect(['job-card/index']);
//                }
//            }
//            return $this->redirect(['job-card/view2', 'id' => $item->job_card_id]);
//            return $this->redirect(['job-card-items/recieve']);
        }
    }

    public function actionRecieveFromService() {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $post = $request->post();
        $id = $post["id"];

        $item = JobCardItems::findOne(['id' => $id]);


        if ($item) {

            $items = Item::findOne(['id' => $item->item_id]);
            $itemName = $items['name'];
            $status = Status::findOne(['id' => $item->status]);
            $statusName = $status['name'];
            $jobcard = JobCard::findOne(["id" => $item->job_card_id]);
            $customer = Customer::findOne(['id' => $jobcard->customer_id]);

            $location = Branch::findOne(["id" => $jobcard->branch_id]);
            $locationName = $location->name;


            $message = "Hello " . $customer->name . "\r\nYour item : " . $itemName . "\r\nJob Card nb:  " . $item['job_card_id'] . "\r\nStatus : " . $statusName . "\r\nYou Cant get it from " . $locationName . " Branch";
            Yii::$app->mailer->compose()
                    ->setFrom('service.get4lessghana@gmail.com')
                    ->setTo($customer->email)
                    ->setSubject("Item Ready")
                    ->setTextBody($message)
                    ->send();
//            return [
//                "success" => true,
//                "message" => "successfully recieved item from service center"
//            ];
//            $message = Yii::$app->twilio->sms($customer->phone, $message, ['from' => '+16503185356']);
            $message = Yii::$app->twilio->sms($customer->phone, $message, ['from' => '+13302720108']);
//, ['from' => '+16503185356']

            Yii::$app->mailer->compose()
                    ->setFrom('service.get4lessghana@gmail.com')
                    ->setTo($customer->email)
                    ->setSubject("Item Ready")
                    ->setTextBody($message)
                    ->send();
            $item->current_location = JobCard::LOCATION_BRANCH;
            $item->update();
            $item->save();

            return [
                "success" => true,
                "message" => "successfully recieved item from service center"
            ];






//            $jobcarditem = JobCardItems::find()
//                    ->where(['job_card_id' => $item->job_card_id])
//                    ->andWhere(['current_location' => JobCard::LOCATION_SENT_TO_BRANCH])
//                    ->all();
//            if (!$jobcarditem) {
//                $jobcard = JobCard::findOne(['id' => $item->job_card_id]);
//                $jobcard->current_location = JobCard::LOCATION_BRANCH;
//                if ($jobcard->save()) {
//                    return $this->redirect(['job-card-items/recieve']);
//                }
//            }
        } else {
            return [
                "success" => false,
                "message" => "item does not exist"
            ];
        }
    }

    public function actionJobCardDetail() {

        $model = new JobCardDetailsModel();

        if ($model->load($this->request->post())) {
            $searchModel = new JobCardItemsSearch();
            $dataProvider = $searchModel->mysearch($this->request->queryParams, $model->job_card_id);

            return $this->render('job-card-details', [
                        'model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('job-card-details', [
                    'model' => $model
        ]);
    }

    public function actionRequestCostConfirmation() {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $post = $request->post();
        $id = $post["id"];
        $cost = $post["cost"];

        $item = JobCardItems::findOne(['id' => $id]);


        if ($item) {

            $items = Item::findOne(['id' => $item->item_id]);
            $itemName = $items['name'];
            $status = Status::findOne(['id' => $item->status]);
            $statusName = $status['name'];
            $jobcard = JobCard::findOne(["id" => $item->job_card_id]);
            $customer = Customer::findOne(['id' => $jobcard->customer_id]);

            $location = Branch::findOne(["id" => $jobcard->branch_id]);
            $locationName = $location->name;


            $message = "Hello " . $customer->name . "\r\nYour item : " . $itemName . "\r\nJob Card nb:  " . $item['job_card_id'] . "\r\nRepairing Cost is : " . $cost . "\r\nAwaiting Your approve to start repairing";

//            return [
//                "success" => true,
//                "message" => "successfully recieved item from service center"
//            ];
//            $message = Yii::$app->twilio->sms($customer->phone, $message, ['from' => '+16503185356']);
//            $message = Yii::$app->twilio->sms($customer->phone, $message, ['from' => '+13302720108']);
//, ['from' => '+16503185356']

            Yii::$app->mailer->compose()
                    ->setFrom('service.get4lessghana@gmail.com')
                    ->setTo($customer->email)
                    ->setSubject("Item Repairing Cost Confirmation")
                    ->setTextBody($message)
                    ->send();
            $item->email_sent = 1;
            $item->cost = $cost;
            $item->update();
            if ($item->save()) {
                return $this->redirect('job-card-items/indexinstock');
            }

//            return [
//                "success" => true,
//                "message" => "successfully recieved item from service center"
//            ];
//            $jobcarditem = JobCardItems::find()
//                    ->where(['job_card_id' => $item->job_card_id])
//                    ->andWhere(['current_location' => JobCard::LOCATION_SENT_TO_BRANCH])
//                    ->all();
//            if (!$jobcarditem) {
//                $jobcard = JobCard::findOne(['id' => $item->job_card_id]);
//                $jobcard->current_location = JobCard::LOCATION_BRANCH;
//                if ($jobcard->save()) {
//                    return $this->redirect(['job-card-items/recieve']);
//                }
//            }
        } else {
            return [
                "success" => false,
                "message" => "item does not exist"
            ];
        }
    }

}
