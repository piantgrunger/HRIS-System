<?php

namespace app\controllers\settings;

use Yii;
use app\models\settings\Modules;
use app\models\settings\ModulesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ModulesController implements the CRUD actions for Modules model.
 */
class ModulesController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'view', 'delete', 'update', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Modules models.
     * @return mixed
     */
    public function actionIndex() {
        $module = Modules::findOne(['name' => 'Modules']);
        if (Modules::hasAccess($module->id)) {
            $searchModel = new ModulesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'view' => Modules::hasVisible($module->id, 'view'),
                        'create' => Modules::hasVisible($module->id, 'create'),
                        'edit' => Modules::hasVisible($module->id, 'edit'),
                        'delete' => Modules::hasVisible($module->id, 'delete')
            ]);
        } else {
            throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
        }
    }

    /**
     * Displays a single Modules model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $module = Modules::findOne(['name' => 'Modules']);
        if (Modules::hasAccess($module->id, 'view')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
        }
    }

    /**
     * Creates a new Modules model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $module = Modules::findOne(['name' => 'Modules']);
        if (Modules::hasAccess($module->id, 'create')) {
            $model = new Modules();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('notifikasi', [
                    'type' => 'info',
                    'message' => 'Insert successful',
                    'title' => 'Information',
                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
        }
    }

    /**
     * Updates an existing Modules model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $module = Modules::findOne(['name' => 'Modules']);
        if (Modules::hasAccess($module->id, 'edit')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('notifikasi', [
                    'type' => 'info',
                    'message' => 'Update successful',
                    'title' => 'Information',
                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
        }
    }

    /**
     * Deletes an existing Modules model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $module = Modules::findOne(['name' => 'Modules']);
        if (Modules::hasAccess($module->id, 'delete')) {
            Yii::$app->session->setFlash('notifikasi', [
                'type' => 'info',
                'message' => 'Delete successful',
                'title' => 'Information',
            ]);
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
        }
    }

    /**
     * Finds the Modules model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Modules the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Modules::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
