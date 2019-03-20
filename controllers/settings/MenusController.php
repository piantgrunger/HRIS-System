<?php

namespace app\controllers\settings;

use Yii;
use app\models\settings\Menus;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\settings\Modules;
use yii\filters\AccessControl;

/**
 * MenusController implements the CRUD actions for Menus model.
 */
class MenusController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'view', 'insert', 'ajax', 'delete', 'update', 'index'],
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
     * Lists all Menus models.
     * @return mixed
     */
    public function actionIndex() {
        $module = Modules::findOne(['name' => 'Menus']);
        if (Modules::hasAccess($module->id)) {
            $model = new Menus();
            if ($model->load(Yii::$app->request->post())) {
                if ($_SESSION['nonce'] == $_POST['nonce']) {
                    if (Modules::hasAccess($module->id, 'create')) {
                        $model->created_at = date('Y-m-d H:i:s');
                        $model->module_id = 0;
                        $model->save();
                        $_SESSION['nonce'] = null;
                        Yii::$app->session->setFlash('notifikasi', [
                            'message' => 'Insert successful',
                            'title' => 'Information',
                        ]);
                    } else {
                        throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
                    }
                }
            }

            $menus = Menus::find()->where(['parent' => 0])->orderBy('hierarchy ASC')->all();
            return $this->render('index', [
                        'menus' => $menus,
                        'model' => $model,
                        'val' => ''
            ]);
        } else {
            throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
        }
    }

    /**
     * Displays a single Menus model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $module = Modules::findOne(['name' => 'Menus']);
        if (Modules::hasAccess($module->id, 'view')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
        }
    }

    /**
     * Creates a new Menus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $module = Modules::findOne(['name' => 'Menus']);
        if (Modules::hasAccess($module->id, 'edit')) {
            $model = new Menus();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
     * Updates an existing Menus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $module = Modules::findOne(['name' => 'Menus']);
        if (Modules::hasAccess($module->id, 'edit')) {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $menus = Menus::find()->where(['parent' => 0])->orderBy('hierarchy ASC')->all();
                return $this->render('index', [
                            'menus' => $menus,
                            'model' => $model,
                            'val' => ''
                ]);
            }

            return $this->renderAjax('update', [
                        'model' => $model,
                        'jsasset' => $jsasset,
                        'val' => ''
            ]);
        } else {
            throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
        }
    }

    /**
     * Deletes an existing Menus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $module = Modules::findOne(['name' => 'Menus']);
        if (Modules::hasAccess($module->id, 'delete')) {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('notifikasi', [
                'message' => 'Delete successful',
                'title' => 'Information',
            ]);
            return $this->redirect(['index']);
        } else {
            throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
        }
    }

    /**
     * Finds the Menus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Menus::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAjax() {

        $request = Yii::$app->request;
        $parents = $request->post('jsonData');
        $parent_id = 0;
        $data['success'] = false;
        for ($i = 0; $i < count($parents); $i++) {
            $this->apply_hierarchy($parents[$i], $i + 1, $parent_id);
            $data['success'] = true;
        }

        return Json::encode($data);
    }

    function apply_hierarchy($menuItem, $num, $parent_id) {
        $menu = $model = $this->findModel($menuItem['id']);
        $menu->parent = $parent_id;
        $menu->hierarchy = $num;
        $menu->save();

        if (isset($menuItem['children'])) {
            for ($i = 0; $i < count($menuItem['children']); $i++) {
                $this->apply_hierarchy($menuItem['children'][$i], $i + 1, $menuItem['id']);
            }
        }
    }

    public function actionInsert() {

        $request = Yii::$app->request;
        $moduleId = $request->post('module_id');
        $moduleType = $request->post('type');

        $modules = Modules::find()->where(['id' => $moduleId])->one();

        $data['success'] = false;
        if ($request->post()) {
            $model = new Menus();
            $model->name = $modules->name;
            $model->url = $modules->url;
            $model->module_id = $modules->id;
            $model->icon = $modules->fa_icon;
            $model->type = $moduleType;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save(false);
            $data['success'] = true;
        }
        return Json::encode($data);
    }

}
