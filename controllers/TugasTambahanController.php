<?php

namespace app\controllers;

use Yii;
use app\models\TugasTambahan;
use app\models\TugasTambahanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TugasTambahanController implements the CRUD actions for TugasTambahan model.
 */
class TugasTambahanController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TugasTambahan models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TugasTambahanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $jml = 0;
        if (Yii::$app->user->identity->is_atasan) {
            $jm = TugasTambahan::find()->where(['id_penilai' => Yii::$app->user->identity->id_pegawai, 'status' => 'Diajukan'])
                ->count();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jml' => $jml,
        ]);
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index-approve');
        } else {
            if ($model->id_penilai === yii::$app->user->identity->id_pegawai) {
                return $this->renderAjax('view', [
                        'model' => $model,
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Anda Tidak Memiliki Akses Untuk Melakukan Hal ini');

                return $this->redirect(['index']);
            }
        }
    }

    public function actionIndexApprove()
    {
        $searchModel = new TugasTambahanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('index-approve', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TugasTambahan model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TugasTambahan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TugasTambahan();

        if ($model->load(Yii::$app->request->post()) && $model->upload('file_pendukung') && $model->save()) {
            return  $this->redirect('index');
        } else {
            if (!is_null(Yii::$app->user->identity->pegawai)) {
                $model->id_pegawai = Yii::$app->user->identity->pegawai->id_pegawai;
                if (!is_null(Yii::$app->user->identity->pegawai->pegawai_atasan)) {
                    $model->id_penilai = Yii::$app->user->identity->pegawai->pegawai_atasan->id_pegawai;

                    $model->tahun = date('Y');
                    $model->bulan = date('m');

                    return $this->render('create', [
                        'model' => $model,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error', ' Data Atasan Anda Belum di Isi Harap Hubungi Administrator');
                    $this->redirect('index');
                }
            }
        }
    }

    /**
     * Updates an existing TugasTambahan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_tugas_tambahan]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TugasTambahan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (\yii\db\IntegrityException  $e) {
            Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dihapus Karena Dipakai Modul Lain');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the TugasTambahan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return TugasTambahan the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TugasTambahan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
