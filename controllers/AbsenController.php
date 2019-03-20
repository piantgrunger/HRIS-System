<?php

namespace app\controllers;

use Yii;
use app\models\Ijin;
use app\models\UnitKerja;
use app\models\Absen;
use app\models\AbsenSearch;
use yii\web\Controller;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\JenisAbsen;
use app\helpers\myhelpers;

/**
 * AbsenController implements the CRUD actions for Absen model.
 */
class AbsenController extends Controller
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
     * Lists all Absen models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AbsenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexIjin()
    {
        $searchModel = new AbsenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('index-ijin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Absen model.
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
     * Creates a new Absen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Absen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_absen]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateTerlambat()
    {
        $model = new Absen();
        if ($model->load(Yii::$app->request->post())) {
            $absenTerlambat = Absen::find()->where('id_absen=' . $model->id_absen_terlambat)->one();
            if (!is_null($absenTerlambat)) {
                $model->upload('file_pendukung');
                $jenisAbsen = JenisAbsen::find()->where("nama_jenis_absen='Ijin Terlambat'")->one();

                $tgl2=$absenTerlambat->tgl_absen;
                $model1 = Ijin::find()->where(['id_pegawai' => $model->id_pegawai])->andWhere("tgl_absen ='$tgl2'")->one();

                if (is_null($model1)) {
                    $model1 = new Ijin();
                }
                $model1->scenario = 'Cuti';

                $model1->tgl_absen = $tgl2;
                $model1->id_jenis_absen = $jenisAbsen->id_jenis_absen;
                $model1->id_pegawai = $model->id_pegawai;
                $model1->alasan = $model->alasan;
                $model1->status = 'Belum Divalidasi';

                $model1->file_pendukung = $model->file_pendukung;
                $model1->save();
                return $this->redirect('index');
            }
        }
        return $this->render('create_terlambat', [
            'model' => $model,
        ]);
    }


    public function actionCreatePulangAwal()
    {
        $model = new Absen();
        if ($model->load(Yii::$app->request->post())) {
            $absenTerlambat = Absen::find()->where('id_absen=' . $model->id_absen_terlambat)->one();
            if (!is_null($absenTerlambat)) {
                $model->upload('file_pendukung');

                $jenisAbsen = JenisAbsen::find()->where("nama_jenis_absen='Ijin Pulang Awal'")->one();

                $tgl2=$absenTerlambat->tgl_absen;
                $model1 = Ijin::find()->where(['id_pegawai' => $model->id_pegawai])->andWhere("tgl_absen ='$tgl2'")->one();

                if (is_null($model1)) {
                    $model1 = new Ijin();
                }

                $model1->scenario = 'Cuti';
                $model1->tgl_absen = $tgl2;
                $model1->id_jenis_absen = $jenisAbsen->id_jenis_absen;
                $model1->id_pegawai = $model->id_pegawai;
                $model1->alasan = $model->alasan;
                $model1->status = 'Belum Divalidasi';

                $model1->file_pendukung = $model->file_pendukung;
                $model1->save();
                return $this->redirect('index');
            }
        }
        return $this->render('create_pulang_awal', [
            'model' => $model,
        ]);
    }

    public function actionCreateIjin()
    {
        $model = new Absen();
      $model->scenario = 'Cuti';
        if ($model->load(Yii::$app->request->post())) {

            $model->upload('file_pendukung');
            $model->tgl_awal = implode('-', array_reverse(explode('-', $model->tgl_awal)));
            $model->tgl_akhir = implode('-', array_reverse(explode('-', $model->tgl_akhir)));
            $tgl = date_create($model->tgl_awal);
            $akhir = date_create($model->tgl_akhir);
            while ($tgl <= $akhir) {
                $tgl1 = date_format($tgl, 'd-m-Y');
                $tgl2 = date_format($tgl, 'Y-m-d');
                $model1 = Absen::find()->where(['id_pegawai' => $model->id_pegawai])->andWhere("tgl_absen ='$tgl2'")->one();
                if (!myhelpers::isLibur($tgl1, $model->id_pegawai)) {
                    if (is_null($model1)) {
                        $model1 = new Absen();
                    }
                    $model1->scenario = 'Cuti';
                    $model1->tgl_absen = $tgl1;
                    $model1->id_jenis_absen = $model->id_jenis_absen;
                    $model1->id_pegawai = $model->id_pegawai;
                    $model1->alasan = $model->alasan;
                 //   $model1->masuk_kerja = '00:00';
                   // $model1->pulang_kerja = '00:00';
                    $model1->terlambat_kerja =0;
                    $model1->pulang_awal =0;
                   
                    $model1->file_pendukung = $model->file_pendukung;
                    $model2 = Ijin::find()->where(['id_pegawai' => $model->id_pegawai])->andWhere("tgl_absen ='$tgl2'")->one();
                    if (is_null($model2)) {
                        $model2 = new Ijin();
                    }
                    $model2->tgl_absen = $tgl2;
                    $model2->id_jenis_absen = $model->id_jenis_absen;
                    $model2->id_pegawai = $model->id_pegawai;
                    $model2->alasan = $model->alasan;
                    $model2->file_pendukung = $model->file_pendukung;
                    $model2->status ='Sudah Divalidasi';

                    $model2->save();

                    if (!$model1->save()) {
                        return $this->render('create_ijin', [
                        'model' => $model1,
                        ]);
                    }
                }
                date_add($tgl, date_interval_create_from_date_string('1 days'));
            }
            return $this->redirect('index');
        } else {
            return $this->render('create_ijin', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Absen model.
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
            return $this->redirect(['view', 'id' => $model->id_absen]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDataTerlambat()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = $_POST['depdrop_parents'];
            $data=   Absen::find()->where(['id_pegawai' => $id])
                ->select(['id_absen', 'ket' => new Expression("concat( DATE_FORMAT(tgl_absen,'%d  - %m - %Y') ,' Terlambat ', round(coalesce(terlambat_kerja,0))  ,' Jam ' )")])
                ->andWhere(new Expression('YEAR(tgl_absen) = YEAR(CURRENT_DATE)'))
                ->andWhere(new Expression('MONTH(tgl_absen) = MONTH(CURRENT_DATE)'))
                ->andWhere(new Expression('masuk_kerja is not null'))
                ->andWhere(['>', 'terlambat_kerja', 0])->all();

            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id_absen'], 'name' => $list['ket']];
            }

            return Json::encode(['output' => $out, 'selected' => '']);
        }

        return Json::encode(['output' => '', 'selected' => '']);
    }
    public function actionDataPulangAwal()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = $_POST['depdrop_parents'];
            $data = Absen::find()->where(['id_pegawai' => $id])
                ->select(['id_absen', 'ket' => new Expression("concat( DATE_FORMAT(tgl_absen,'%d  - %m - %Y') ,' Pulang Awal  ', round(coalesce(pulang_awal,0))  ,' Jam ' )")])
                ->andWhere(new Expression('YEAR(tgl_absen) = YEAR(CURRENT_DATE)'))
                ->andWhere(new Expression('MONTH(tgl_absen) = MONTH(CURRENT_DATE)'))
                ->andWhere(new Expression('pulang_kerja is not null'))
                    ->andWhere(['>', 'pulang_awal', 0])->all();

            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id_absen'], 'name' => $list['ket']];
            }

            return Json::encode(['output' => $out, 'selected' => '']);
        }

        return Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * Deletes an existing Absen model.
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
     * Finds the Absen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Absen the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionMultipleDelete()
    {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) {
            $this->findModel($value)->delete();
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Absen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
