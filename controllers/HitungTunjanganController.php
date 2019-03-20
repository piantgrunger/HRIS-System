<?php

namespace app\controllers;

use kartik\mpdf\Pdf;
use Yii;
use app\models\HitungTunjangan;
use app\models\HitungTunjanganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\jobs\GenerateAbsenJob;
use app\models\Validasi;

/**
 * HitungTunjanganController implements the CRUD actions for HitungTunjangan model.
 */
class HitungTunjanganController extends Controller
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
     * Lists all HitungTunjangan models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HitungTunjanganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HitungTunjangan model.
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

    public function actionPrint($id)
    {
        $model=$this->findModel($id);

        $satuanKerja = \app\models\SatuanKerja::findOne($model->id_satuan_kerja);
        if (is_null(Validasi::find()->where(["id_satuan_kerja" => $model->id_satuan_kerja, "periode" => date("m-Y", strtotime($model->tgl_awal))])->one())) {
            Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dicetak Karena Satuan Kerja : ' . $satuanKerja->nama_satuan_kerja . ' Belum di Validasi pada Periode Ini');
            return $this->redirect("index");
        }
        $content = $this->renderPartial('laporan', [
            'model' => $model,
        ]);
        $customFontsConfig = Yii::$app->basePath."/helpers/custom_config.php" ;
        $customFonts = Yii::$app->homeUrl."/fonts";
        define("_MPDF_SYSTEM_TTFONTS_CONFIG", $customFontsConfig);
        define("_MPDF_SYSTEM_TTFONTS", $customFonts);
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
                 'cssInline' => "html {font-face:cambria;}",

            // any css to be embedded if required
                     //'cssInline' => '.kv-heading-1{font-size:18px}',
             // set mPDF properties on the fly
                     'options' => ['title' => 'Cetak  '],
             // call mPDF methods on the fly
                 ]);

        return $pdf->render();
    }

    /**
     * Creates a new HitungTunjangan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HitungTunjangan();
        if (!is_null(Yii::$app->user->identity->id_satuan_kerja)) {
            $model->id_satuan_kerja = Yii::$app->user->identity->id_satuan_kerja;
        }

        if ($model->load(Yii::$app->request->post())&&$model->cekValidasi() && $model->save()) {
            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("call `hitung_tunjangan`('$model->tgl_awal', '$model->tgl_akhir', '$model->id_satuan_kerja', '$model->id_hitung_tunjangan')");
            $command->execute();

            return $this->redirect(['view', 'id' => $model->id_hitung_tunjangan]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HitungTunjangan model.
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
            return $this->redirect(['view', 'id' => $model->id_hitung_tunjangan]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HitungTunjangan model.
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
     * Finds the HitungTunjangan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return HitungTunjangan the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HitungTunjangan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
