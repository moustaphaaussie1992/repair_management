<?php

namespace app\controllers;

use app\models\Brand;
use app\models\ContactForm;
use app\models\Item;
use app\models\LoginForm;
use moonland\phpexcel\Excel;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
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

        return $this->goHome();
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
        $message = Yii::$app->twilio->sms('+96181756788', "arsenal feshleen");
        return "success";
    }

    public function actionSendEmailMessage() {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $email = $request->post('email');
        $subject = $request->post('subject');
        $email = $request->post('email');
        $message = $request->post('message');

        Yii::$app->mailer->compose()
                ->setFrom('service.get4lessghana@gmail.com')
                ->setTo($email)
                ->setSubject($subject)
                ->setTextBody('hayda l body lal email')
                ->send();
//        
//        Yii::$app->mailer->compose()
//                ->setFrom('service.get4lessghana@gmail.com')
//                ->setTo('moustaphaaussie@gmail.com')
//                ->setSubject('mawdo3 l email')
//                ->setTextBody('hayda l body lal email')
//                ->setHtmlBody('<b>Real Madrid l oussa kella ma3 chambers 3al defe3</b>')
//                ->send();
    }

//    public static function sendMessage($message){
//        $message = Yii::$app->twilio->sms('+96181756788', $message);
//        return "success";
//    }
}
