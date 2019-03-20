<?php

namespace app\controllers;

use Yii;
use yii\helpers\Json;
use app\models\RealisasiSasaranKerja;
use app\models\RealisasiSasaranKerjaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\DetSasaranKinerjaPegawai;
use app\helpers\myhelpers;

/**
 * RealisasiSasaranKerjaController implements the CRUD actions for RealisasiSasaranKerja model.
 */
class RealisasiSasaranKerjaController extends Controller
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
     * Lists all RealisasiSasaranKerja models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RealisasiSasaranKerjaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 0);

        $jmlRealisasi = 0;
        if (Yii::$app->user->identity->is_atasan) {
            $jmlRealisasi = RealisasiSasaranKerja::find()
            ->innerJoin('tb_mt_skp', 'tb_mt_skp.id_skp = tb_mt_realisasi.id_skp')
            ->where(['id_penilai' => Yii::$app->user->identity->id_pegawai, 'status_realisasi' => 'Diajukan'])
                ->count();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jmlRealisasi' => '$jmlRealisasi',
        ]);
    }

    public function actionIndexApprove()
    {
        $searchModel = new RealisasiSasaranKerjaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('index-approve', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RealisasiSasaranKerja model.
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
     * Creates a new RealisasiSasaranKerja model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RealisasiSasaranKerja();

        if ($model->load(Yii::$app->request->post()) && $model->upload('file_pendukung') && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RealisasiSasaranKerja model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->upload('file_pendukung') && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RealisasiSasaranKerja model.
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

    public function actionSkp()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = $_POST['depdrop_parents'];
            $data = DetSasaranKinerjaPegawai::find()
                ->select([
                    'id' => 'id_d_skp', 'name' => 'bulan',
                ])
                ->where(['id_skp' => $id])

                ->asArray()
                ->all();
            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id'], 'name' => myhelpers::getMonth($list['name'])];
            }

            return Json::encode(['output' => $out, 'selected' => '']);
        }

        return Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionDetailSkp($id)
    {
        $model = DetSasaranKinerjaPegawai::findOne(['id_d_skp' => $id]);

        return Json::encode([
            'kuantitas' => $model->kuantitas,
            'satuan_kuantitas' => $model->satuan_kuantitas,
        ]);
    }

    /**
     * Finds the RealisasiSasaranKerja model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return RealisasiSasaranKerja the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RealisasiSasaranKerja::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index-approve');
        } else {
            if ($model->skp->id_penilai === yii::$app->user->identity->id_pegawai) {
                return $this->renderAjax('view', [
                        'model' => $model,
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Anda Tidak Memiliki Akses Untuk Melakukan Hal ini');

                return $this->redirect(['index']);
            }
        }
    }
}
