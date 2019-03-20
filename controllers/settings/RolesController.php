<?php

namespace app\controllers\settings;

use Yii;
use app\models\settings\Roles;
use app\models\settings\Modules;
use app\models\settings\RolesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\settings\RolesModule;
use app\models\settings\RolesCompany;
use yii\filters\AccessControl;

/**
 * RolesController implements the CRUD actions for Roles model.
 */
class RolesController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'view', 'delete', 'update', 'index', 'save_module_role_permissions', 'save_company_role_permissions'],
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
     * Lists all Roles models.
     * @return mixed
     */
    public function actionIndex() {
        $module = Modules::findOne(['name' => 'Roles']);
        if (Modules::hasAccess($module->id)) {
            $searchModel = new RolesSearch();
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
     * Displays a single Roles model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $module = Modules::findOne(['name' => 'Roles']);
        if (Modules::hasAccess($module->id, 'view')) {
            $modules_access = Roles::getRolesModules($id);
            return $this->render('view', [
                        'model' => $this->findModel($id),
                        'modules_access' => $modules_access,
                        'tabaccess' => '',
                        'tabinfo' => 'active',
                        'tabcompany' => '',
            ]);
        } else {
            throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
        }
    }

    /**
     * Creates a new Roles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $module = Modules::findOne(['name' => 'Roles']);
        if (Modules::hasAccess($module->id, 'create')) {
            $model = new Roles();
            $model->created_at = date('Y-m-d H:i:s');
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
     * Updates an existing Roles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $module = Modules::findOne(['name' => 'Roles']);
        if (Modules::hasAccess($module->id, 'edit')) {
            $model = $this->findModel($id);
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
     * Deletes an existing Roles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $module = Modules::findOne(['name' => 'Roles']);
        if (Modules::hasAccess($module->id, 'delete')) {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('notifikasi', [
                'type' => 'info',
                'message' => 'Delete successful',
                'title' => 'Information',
            ]);
            return $this->redirect(['index']);
        } else {
            throw new \yii\web\HttpException(403, "Damn You!, you are not authorized to perform this action.");
        }
    }

    /**
     * Finds the Roles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Roles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Roles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionSave_module_role_permissions() {
        $request = Yii::$app->request;
        $id = $request->post('id');
        $model = new Roles();
        $module = Modules::find()
                ->orderBy('id ASC')
                ->all();

        foreach ($module as $key => $value) {
            $module_name = $request->post('module_' . $value->id, '');
            if ($module_name) {
                $view = $request->post('module_view_' . $value->id, '');
                $create = $request->post('module_create_' . $value->id, '');
                $edit = $request->post('module_edit_' . $value->id, '');
                $delete = $request->post('module_delete_' . $value->id, '');

                if ($view) {
                    $view = 1;
                } else {
                    $view = 0;
                }
                if ($create) {
                    $create = 1;
                } else {
                    $create = 0;
                }
                if ($edit) {
                    $edit = 1;
                } else {
                    $edit = 0;
                }
                if ($delete) {
                    $delete = 1;
                } else {
                    $delete = 0;
                }

                $roleModule = new RolesModule();
                $dataRoleModul = RolesModule::find()->where(['role_id' => $id, 'module_id' => $value->id]);

                if ($dataRoleModul->count() == 0) {
                    $roleModule->role_id = $id;
                    $roleModule->module_id = $value->id;
                    $roleModule->acc_view = $view;
                    $roleModule->acc_create = $create;
                    $roleModule->acc_edit = $edit;
                    $roleModule->acc_delete = $delete;
                    $roleModule->created_at = date('Y-m-d H:i:s');
                    $roleModule->save();
                } else {
                    RolesModule::updateAll([
                        'acc_view' => $view,
                        'acc_create' => $create,
                        'acc_edit' => $edit,
                        'acc_delete' => $delete,
                        'updated_at' => date('Y-m-d H:i:s')
                            ], "role_id = " . $id . " AND module_id = " . $value->id);
                }
            } else {
                RolesModule::updateAll([
                    'acc_view' => 0,
                    'acc_create' => 0,
                    'acc_edit' => 0,
                    'acc_delete' => 0,
                    'updated_at' => date('Y-m-d H:i:s')
                        ], "role_id = " . $id . " AND module_id = " . $value->id);
            }
        }

        /* $company_access = Company::find()
          ->select('company.comp_no,company.comp_name,company.comp_code,role_company.acc_view as comp_view')
          ->leftJoin('role_company','company.comp_code=role_company.company_id AND role_company.role_id='.$id)
          ->all(); */

        $modules_access = $model->getRolesModules($id);
        Yii::$app->session->setFlash('notifikasi', [
            'type' => 'info',
            'message' => 'Update Module Accesses Role successful',
            'title' => 'Information',
        ]);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'modules_access' => $modules_access,
                    'tabaccess' => 'active',
                    'tabinfo' => '',
                    'tabcompany' => '',
        ]);
    }

    public function actionSave_company_role_permissions() {
        $request = Yii::$app->request;
        $id = $request->post('id');
        $roles = new Roles();
        $company = Company::find()
                ->orderBy('comp_code ASC')
                ->all();

        foreach ($company as $key => $value) {
            $company_name = $request->post('company_' . $value->comp_code, '');
            $view = 0;

            if ($company_name)
                $view = 1;


            $roleCompany = new RolesCompany();
            $dataRoleComp = RolesCompany::find()->where(['role_id' => $id, 'company_id' => $value->comp_code]);

            if ($dataRoleComp->count() == 0) {
                $roleCompany->role_id = $id;
                $roleCompany->company_id = $value->comp_code;
                $roleCompany->acc_view = $view;
                $roleCompany->created_at = date('Y-m-d H:i:s');
                $roleCompany->save();
            } else {
                RolesCompany::updateAll([
                    'acc_view' => $view,
                    'updated_at' => date('Y-m-d H:i:s')
                        ], "role_id = " . $id . " AND company_id = '" . $value->comp_code . "'");
            }
        }


        $modules_access = Roles::getRolesModules($id);
        $company_access = Company::find()
                ->select('company.comp_no,company.comp_name,company.comp_code,role_company.acc_view as comp_view')
                ->leftJoin('role_company', 'company.comp_code=role_company.company_id AND role_company.role_id=' . $id)
                ->all();
        Yii::$app->session->setFlash('notifikasi', [
            'type' => 'info',
            'message' => 'Update Company Role successful',
            'title' => 'Information',
        ]);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'modules_access' => $modules_access,
                    'company_access' => $company_access,
                    'tabaccess' => '',
                    'tabinfo' => '',
                    'tabcompany' => 'active',
        ]);
    }

}
