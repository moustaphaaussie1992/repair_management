<?php

namespace app\controllers;

use app\models\Family;
use app\models\FamilySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FamilyController implements the CRUD actions for Family model.
 */
class FamilyController extends Controller {

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
     * Lists all Family models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new FamilySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Family model.
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
     * Creates a new Family model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Family();

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
     * Updates an existing Family model.
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
     * Deletes an existing Family model.
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
     * Finds the Family model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Family the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Family::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFamilySelect() {




        $family = (isset(Yii::$app->request->queryParams["ItemSarch"]["family"])) ? Yii::$app->request->queryParams["AppointmentsSearch"]["family"] : null;

        $subfamily = (isset(Yii::$app->request->queryParams["ItemSarch"]["subfamily"])) ? Yii::$app->request->queryParams["AppointmentsSearch"]["subfamily"] : null;
        $subsubfamily = (isset(Yii::$app->request->queryParams["ItemSarch"]["subsubfamily"])) ? Yii::$app->request->queryParams["AppointmentsSearch"]["subsubfamily"] : null;


        if ($family) {

            $subfamily = \app\models\Subfamily::getSubfamiliesbyfamily($family);

            if ($family && $family != "" && $subfamily && $subfamily != "") {
                $subsubfamily = \app\models\Subsubfamily::getSubsubfamiliesbyfamily($subfamily);
            }
        }



        return $this->render('create', [
                    'subfamily' => $subfamily,
                    'subsubfamily' => $subsubfamily,
        ]);
    }

}
