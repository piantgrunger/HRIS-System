<?php

namespace app\controllers;

use Yii;
use app\models\Pegawai;
use app\models\PegawaiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UnitKerja;
use yii\helpers\Json;
use app\models\JabatanFungsional;
use app\models\RiwayatJabatan;

/**
 * PegawaiController implements the CRUD actions for Pegawai model.
 */
class PegawaiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actionGolongan()
    {
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    /**
     * Lists all Pegawai models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, null);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUnitKerja()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = $_POST['depdrop_parents'];
            $data = UnitKerja::find()
                ->select([
                    'id' => 'id_unit_kerja', 'name' => 'nama_unit_kerja',
                ])
                ->where(['id_satuan_kerja' => $id])

                ->asArray()
                ->all();
            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id'], 'name' => $list['name']];
            }

            return Json::encode(['output' => $out, 'selected' => '']);
        }

        return Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionJabatan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = $_POST['depdrop_parents'];
            $data = JabatanFungsional::find()
                ->select([
                    'id' => 'id_jabatan_fungsional', 'name' => 'nama_jabatan_fungsional',
                ])
               // ->where(['in'  , 'id_satuan_kerja' , [$id,'0']])
              ->Where(['or', ['or', ['id_satuan_kerja' => null], ['id_satuan_kerja' => 0]], ['id_satuan_kerja' => $id]])
                ->orderBy('id_satuan_kerja desc ')
                ->asArray()

                ->all();
            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id'], 'name' => $list['name']];
            }

            return Json::encode(['output' => $out, 'selected' => '']);
        }

        return Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionJabatanAtasan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = $_POST['depdrop_parents'];
            $data = JabatanFungsional::find()
                ->select([
                    'id' => 'id_jabatan_fungsional', 'name' => 'nama_jabatan_fungsional',
                ])
               // ->where(['in'  , 'id_satuan_kerja' , [$id,'0']])
                ->Where(['or', ['or', ['like', 'nama_jabatan_fungsional', 'CAMAT'], ['or' ,['nama_jabatan_fungsional' => 'Sekretaris Daerah'],['nama_jabatan_fungsional' =>'KEPALA BAGIAN PEMERINTAHAN'] ] ], ['id_satuan_kerja' => $id]])

                ->orderBy('id_satuan_kerja desc ')
                ->asArray()

                ->all();
            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id'], 'name' => $list['name']];
            }

            return Json::encode(['output' => $out, 'selected' => '']);
        }

        return Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionPns()
    {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 0);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNonPns()
    {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pegawai model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionUpdateKodeChecklog($id)
    {
        $model = $this->findModel($id);
        $model->old_foto = $model->foto;

        if ($model->load(Yii::$app->request->post()) && ($model->save(false))) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('_form_kode_checklog', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Pegawai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pegawai();

        if ($model->load(Yii::$app->request->post()) && $model->upload('foto') && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pegawai]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pegawai model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->old_foto = $model->foto;
        $model->old_tmt = $model->tmt;

        if ($model->load(Yii::$app->request->post()) && $model->upload('foto') && $model->save()) {
            if ($model->old_tmt !== $model->tmt) {
                $riwayat = new RiwayatJabatan();
                $riwayat->id_pegawai = $model->id_pegawai;
                $riwayat->tmt = $model->tmt;
                $riwayat->id_jabatan = $model->id_jabatan_fungsional;
                $riwayat->nama_jabatan = $model->nama_jabatan;
                $riwayat->unit_kerja = $model->nama_unit_kerja;
                $riwayat->save();
            }

            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUploadKelengkapan($id)
    {
        $model = $this->findModel($id);
        $model->old_file_kartu_pegawai = $model->file_kartu_pegawai;
        $model->old_file_sk_cpns = $model->file_sk_cpns;
        $model->old_file_sk_pns = $model->file_sk_pns;

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailFilePangkat = Yii::$app->request->post('DetPegawaiFilePangkat', []);
                $model->detailFileJabatan = Yii::$app->request->post('DetPegawaiFileJabatan', []);
                $model->detailFileSpmt = Yii::$app->request->post('DetPegawaiFileSpmt', []);
                $model->detailFileGaji = Yii::$app->request->post('DetPegawaiFileGaji', []);
                $model->detailFileIjazah = Yii::$app->request->post('DetPegawaiFileIjazah', []);

                if (($model->save())) {
                    $transaction->commit();
                    return $this->redirect(Yii::$app->request->referrer);
                }
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
            return $this->render('upload', [
                'model' => $model,
            ]);
        } else {
            return $this->render('upload', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pegawai model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model= $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && ($model->save(false))) {
            if ($model->status != "Aktif") {
                $model->id_satuan_kerja = null;
                $model->id_unit_kerja = null;
                $model->save(false);
            }
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('_form_status', [
                'model' => $model,
            ]);
        }
        /*
                try {
                    $this->findModel($id)->delete();
                } catch (\yii\db\IntegrityException  $e) {
                    Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dihapus Karena Dipakai Modul Lain');
                }

                return $this->redirect(['index']);
                */
    }

    /**
     * Finds the Pegawai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Pegawai the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pegawai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
