<?php

namespace app\controllers;

use app\models\ChangePassword;
use app\models\Users;
use app\models\UsersSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller {

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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
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
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate() {
//        $model = new Users();
//
//        if ($this->request->isPost) {
//            if ($model->load($this->request->post()) && $model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            } else {
//                \yii\helpers\VarDumper::dump($model->errors, 3, true);
//                die();
//            }
//        } else {
//            $model->loadDefaultValues();
//        }
//
//        return $this->render('create', [
//                    'model' => $model,
//        ]);
//    }

    public function actionCreate() {
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        $model = new Users();
        if ($model->load($request->post()) && $model->signup()) {
            // add role
            $authManager = Yii::$app->authManager;
            $role = $authManager->getRole($model->role);
            $authManager->assign($role, $model->id);

            return $this->redirect(['users/index']);

//            $response->format = Response::FORMAT_JSON;
//            return ['success' => true];
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
//        return $this->renderAjax('create', [
//                    'model' => $model,
//        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionUpdate($id) {
//        $model = $this->findModel($id);
//
//        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//                    'model' => $model,
//        ]);
//    }

    public function actionUpdate($id) {
        $request = Yii::$app->getRequest();
        $response = Yii::$app->getResponse();
        $model = Users::getUser($id);

        if ($model->load($request->post()) && $model->save()) {
            // update role
            $authManager = Yii::$app->authManager;
            $authManager->revokeAll($model->id);
            $role = $authManager->getRole($model->role);
            $authManager->assign($role, $model->id);
            Yii::$app->cache->flush();

//            $response->format = Response::FORMAT_JSON;
//            return ['success' => true];

            return $this->redirect(['users/index']);
        }

        return $this->render('update', [
                    'model' => $model
        ]);
    }

    public function actionChangePassword() {
        $request = Yii::$app->getRequest();
        $session = Yii::$app->session;
        $model = new ChangePassword();

        if ($model->load($request->post()) && $model->change()) {
            $session->setFlash('success', 'The password has beeen changed successfully');
            return $this->goHome();
        }

        return $this->render('change-password', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
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
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
