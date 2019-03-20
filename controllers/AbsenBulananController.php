<?php

namespace app\controllers;

use Yii;
use app\models\AbsenBulanan;
use app\models\Validasi;
use app\models\AbsenBulananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * AbsenBulananController implements the CRUD actions for AbsenBulanan model.
 */
class AbsenBulananController extends Controller
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
     * Lists all AbsenBulanan models.
     *
     * @return mixed
     */

    public function actionCetak($bulan, $tahun, $id_satuan_kerja)
    {
        $satuanKerja = \app\models\SatuanKerja::findOne($id_satuan_kerja);

        if (is_null(Validasi::find()->where(["id_satuan_kerja" => $id_satuan_kerja, "periode" => date("m-Y", strtotime($tahun.'-'.$bulan.'-1'))])->one())) {
            Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dicetak Karena Satuan Kerja : '.$satuanKerja->nama_satuan_kerja.' Belum di Validasi pada Periode Ini');
            return $this->redirect("index");
        }



        $query = AbsenBulanan::find()
        ->innerJoin('tb_m_pegawai', 'tb_m_pegawai.id_pegawai=vw_absen_bulanan.id_pegawai')
            ->leftJoin('tb_m_jabatan_fungsional', 'tb_m_jabatan_fungsional.id_jabatan_fungsional=tb_m_pegawai.id_jabatan_fungsional')
            ->leftJoin('tb_m_golongan', 'tb_m_golongan.id_golongan=tb_m_pegawai.id_golongan')
            ->leftJoin('tb_m_eselon', 'tb_m_eselon.id_eselon=tb_m_jabatan_fungsional.id_eselon')

            ->leftJoin('tb_m_satuan_kerja', 'tb_m_satuan_kerja.id_satuan_kerja=tb_m_pegawai.id_satuan_kerja')

        ;

        $query->orderBy([new \yii\db\Expression('Coalesce(nama_satuan_kerja,\'zzzzzzzzzz\'),coalesce(nama_eselon,\'zzzzzz\'),kode_golongan desc')]);

        $query->andWhere([
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tb_m_pegawai.id_satuan_kerja' => $id_satuan_kerja,
        ]);
        $model = $query->all();
        $content = $this->renderPartial('laporan', [
            'model' => $model,
            'bulan' =>\app\helpers\myhelpers::getMonth($bulan),
            'tahun' => $tahun,
            'nama_skpd' => $satuanKerja->nama_satuan_kerja,
        ]);
        $pdf = new Pdf([
            // set to use core fonts only
                     'mode' => Pdf::MODE_UTF8,
            // A4 paper format
                     'format' => Pdf::FORMAT_FOLIO,
            // portrait orientation
                     'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
                     'destination' => Pdf::DEST_BROWSER,
            // your html content input
                     'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
                //     'cssFile' => '@app/web/css/print.css',
                     'defaultFont' => 'Arial',
                 'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',

            // any css to be embedded if required
                     'cssInline' => '.kv-heading-1{font-size:18px}',
             // set mPDF properties on the fly
                     'options' => ['title' => 'Cetak  '],
             // call mPDF methods on the fly
                 ]);

        return  $pdf->render();
    }

    public function actionIndex()
    {
        $searchModel = new AbsenBulananSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AbsenBulanan model.
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
     * Creates a new AbsenBulanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AbsenBulanan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pegawai]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AbsenBulanan model.
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
            return $this->redirect(['view', 'id' => $model->id_pegawai]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AbsenBulanan model.
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
     * Finds the AbsenBulanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return AbsenBulanan the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AbsenBulanan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
