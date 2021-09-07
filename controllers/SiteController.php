<?php

namespace app\controllers;

use app\models\Branch;
use app\models\ContactForm;
use app\models\Customer;
use app\models\JobCard;
use app\models\JobCardItems;
use app\models\LoginForm;
use app\models\Users;
use Composer\XdebugHandler\Status;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rbac\Item;
use yii\web\Controller;
use yii\web\Response;
use const YII_ENV_TEST;

class SiteController extends Controller {

//    Public $enableCsrfValidation = false;

    public static function allowedDomains() {
        return [
            '*', // star allows all domains
//            'https://sendgrid.api-docs.io',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
//             For cross-domain AJAX request
//            'corsFilter' => [
//                'class' => \yii\filters\Cors::className(),
//                'cors' => [
//                    // restrict access to domains:
//                    'Origin' => static::allowedDomains(),
//                    'Access-Control-Request-Method' => ['POST'],
//                    'Access-Control-Allow-Credentials' => true,
//                    'Access-Control-Max-Age' => 3600, // Cache (seconds)
//                ],
//            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {


//        $data = Excel::import($fileName); // $config is an optional
//        $data = Excel::import('Item List (2).xlsx', [
//                    'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel.
//                    'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric.
//                    'getOnlySheet' => 'Brand', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
//        ]);
//        $dataItems = Excel::import('Item List (2).xlsx', [
//                    'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel.
//                    'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric.
//                    'getOnlySheet' => 'Family', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
//        ]);
//        VarDumper::dump($dataItems, 3, true);
//        die();
//        $dataItems = Item::find()->asArray()->all();
//        for ($j = 0; $j < sizeof($dataItems); $j++) {
//            $itemCode = $dataItems[$j]["code"];
//            $id = $dataItems[$j]["id"];
//
////            \yii\helpers\VarDumper::dump($itemCode, 3, true);
////            die();
//
//            for ($i = 0; $i < sizeof($data); $i++) {
//                $brandName = $data[$i]["Brand Name"];
//                $brandItemCode = $data[$i]["Item Code"];
//                if ($itemCode == $brandItemCode) {
//                    $brand = Brand::findOne(["name" => $brandName]);
//                    $itemmm = Item::findOne(["id" => $id]);
//                    if ($itemmm) {
//                        $itemmm->brand_id = $brand->primaryKey;
//                        if ($itemmm->save()) {
//
//                        } else {
//                            \yii\helpers\VarDumper::dump($itemmm->errors, 3, true);
//                        }
//                    }
//                }
//            }
//        }
//        for ($i = 0; $i < sizeof($data); $i++) {
//            $brandName = $data[$i]["Brand Name"];
//            $brandItemCode = $data[$i]["Item Code"];
//
//            $brand = Brand::findOne([""]);
//        }
//        for ($i = 0; $i < sizeof($data); $i++) {
//
//            $model = Brand::findOne(["name" => $data[$i]["Brand Name"]]);
//            if (!$model) {
//                $brand = new Brand();
//                $brand->name = $data[$i]["Brand Name"];
//                if($brand->save()){
//
//                }else{
//                    VarDumper::dump($brand->errors,3,true);
//                    die();
//                }
//            }
//        }
//        for ($i = 0; $i < sizeof($data); $i++) {
//            $family = $data[$i]["family"];
//            $family2 = $data[$i]["family2"];
//            $family3 = $data[$i]["family3"];
//            $itemCode = $data[$i]["Item Code"];
//            $itemName = $data[$i]["Item Name"];
//
//
//            $familyModel = Family::findOne(["name" => $family]);
//            if (!$familyModel) {
//                $familyModel = new Family();
//                $familyModel->name = $family;
//                if ($familyModel->save()) {
//
//                } else {
//                    VarDumper::dump($familyModel->errors, 3, true);
//                }
//            }
//            $familyId = $familyModel->primaryKey;
//
//            $subFamilyModel = Subfamily::findOne(["name" => $family2]);
//            if (!$subFamilyModel) {
//                $subFamilyModel = new Subfamily();
//                $subFamilyModel->name = $family2;
//                $subFamilyModel->family = $familyId;
//                if ($subFamilyModel->save()) {
//
//                } else {
//                    VarDumper::dump($subFamilyModel->errors, 3, true);
//                }
//            }
//            $subFamilyId = $subFamilyModel->primaryKey;
//
//
//            $subSubFamilyModel = Subsubfamily::findOne(["name" => $family3]);
//            if (!$subSubFamilyModel) {
//                $subSubFamilyModel = new Subsubfamily();
//                $subSubFamilyModel->name = $family3;
//                $subSubFamilyModel->subfamily = $subFamilyId;
//                if ($subSubFamilyModel->save()) {
//
//                } else {
//                    VarDumper::dump($subSubFamilyModel->errors, 3, true);
//                }
//            }
//            $subSubFamilyId = $subSubFamilyModel->primaryKey;
//
//
//            $item = new Item;
//            $item->family = $familyId;
//            $item->subfamily = $subFamilyId;
//            $item->subsubfamily = $subSubFamilyId;
//            $item->name = $itemName;
//            $item->code = $itemCode. "";
////            $item->brand_id
//            if ($item->save()) {
//
//            } else {
//                VarDumper::dump($item->errors, 3, true);
//            }
//        }
//        return "success";
//        VarDumper::dump($data, 3, true);
//        die();


        if (Yii::$app->user->isGuest)
            return Yii::$app->getResponse()->redirect(['site/login']);
        if (Users::isBranchRole()) {
            return $this->render('index');
        }
        if (Users::isServiceRole()) {
            return $this->render('index-service');
        }

        if (Users::isSupervisorRole()) {
            return $this->render('index-supervisor');
        }
        if (Users::isAdminRole()) {
            return $this->render('index-supervisor');
        }

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['login']
        );
//        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionSendSmsMessage() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $message = $request->post('message');
        $phone = $request->post('phone');
        $message = Yii::$app->twilio->sms($phone, $message);
        return "success";
    }

    public function actionSendEmailMessage() {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $email = $request->post('email');
        $subject = $request->post('subject');
        $message = $request->post('message');

        $itemId = $request->post('id');
        $item = JobCardItems::findOne(['id' => $id]);
        $email = "fayadhadi2014@gmail.com";
        $subject = "item ready";
        $message = "your item " . $itemId['item_id' . " " . $itemId['job_card+id'] . " is ready"];

        Yii::$app->mailer->compose()
                ->setFrom('service.get4lessghana@gmail.com')
                ->setTo($email)
                ->setSubject($subject)
                ->setTextBody($message)
                ->send();

        return true;
//
//        Yii::$app->mailer->compose()
//                ->setFrom('service.get4lessghana@gmail.com')
//                ->setTo('moustaphaaussie@gmail.com')
//                ->setSubject('mawdo3 l email')
//                ->setTextBody('hayda l body lal email')
//                ->setHtmlBody('<b>Real Madrid l oussa kella ma3 chambers 3al defe3</b>')
//                ->send();
    }

    public static function sendMessageItemReady($message) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
//        $message = $request->post('message');
//        $phone = $request->post('phone');

        $itemId = $request->post('id');
        $items = Item::findOne(['id' => $item->item_id]);
        $itemName = $items['name'];
        $status = Status::findOne(['id' => $item->status]);
        $statusName = $status['name'];
        $jobcard = JobCard::findOne(["id" => $item->job_card_id]);
        $customer = Customer::findOne(['id' => $jobcard->customer_id]);

        $location = Branch::findOne(["id" => $jobcard->branch_id]);
        $locationName = $location->name;




        $message = "Hello " . $customer->name . "\r\nYour item : " . $itemName . "\r\nJob Card nb:  " . $item['job_card_id'] . "\r\n Status : " . $statusName . "\r\n You Cant get it from " . $locationName . " Branch";
        \yii\helpers\VarDumper::dump($message, 3, true);
        die();

        $message = Yii::$app->twilio->sms($customer->phone, $message);
        return true;
    }

}
