<?php

namespace app\controllers;

use kartik\mpdf\Pdf;
use Yii;
use app\models\SasaranKinerjaPegawai;
use app\models\SasaranKinerjaPegawaiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SasaranKinerjaPegawaiController implements the CRUD actions for SasaranKinerjaPegawai model.
 */
class SasaranKinerjaPegawaiController extends Controller
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

    public function actionLaporan()
    {
        $model = SasaranKinerjaPegawai::find()->where('id_pegawai='.Yii::$app->user->identity->id_pegawai)
          ->andWhere('tahun='.date('Y'))
          ->andWhere("status_skp='Disetujui'")
          ->all();

        $content = $this->renderPartial('laporan', [
                'model' => $model,
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

    /**
     * Lists all SasaranKinerjaPegawai models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SasaranKinerjaPegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $jmlSkp = 0;
        if (Yii::$app->user->identity->is_atasan) {
            $jmlSkp = SasaranKinerjaPegawai::find()->where(['id_penilai' => Yii::$app->user->identity->id_pegawai, 'status_skp' => 'Diajukan'])
                ->count();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jmlSkp' => $jmlSkp,
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
        $searchModel = new SasaranKinerjaPegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('index-approve', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SasaranKinerjaPegawai model.
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
     * Creates a new SasaranKinerjaPegawai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SasaranKinerjaPegawai();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailSasaranKinerjaPegawai = Yii::$app->request->post('detsasarankinerjapegawai', []);
                if (($model->save())) {
                    $transaction->commit();

                    return $this->redirect('index');
                }
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }

            return $this->render('create', [
                'model' => $model,
            ]);

//            return $this->redirect(['view', 'id' => $model->id_skp]);
        } else {
            if (!is_null(Yii::$app->user->identity->pegawai)) {
                $model->id_pegawai = Yii::$app->user->identity->pegawai->id_pegawai;
                if (!is_null(Yii::$app->user->identity->pegawai->pegawai_atasan)) {
                    $model->id_penilai = Yii::$app->user->identity->pegawai->pegawai_atasan->id_pegawai;

                    $model->tahun = date('Y');

                    return $this->render('create', [
                        'model' => $model,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error', ' Data Atasan Anda Belum di Isi Harap Hubungi Administrator');
                    $this->redirect('index');
                }
            } else {
                Yii::$app->session->setFlash('error', ' Anda Tidak Dapat membuat SKP   Harap Hubungi Administrator');
                $this->redirect('index');
            }
        }
    }

    /**
     * Updates an existing SasaranKinerjaPegawai model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailSasaranKinerjaPegawai = Yii::$app->request->post('detsasarankinerjapegawai', []);
                if (($model->save())) {
                    $transaction->commit();

                    return $this->redirect('index');
                }
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }

            return $this->render('update', [
                'model' => $model,
            ]);

        //   return $this->redirect(['view', 'id' => $model->id_skp]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SasaranKinerjaPegawai model.
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
     * Finds the SasaranKinerjaPegawai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return SasaranKinerjaPegawai the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SasaranKinerjaPegawai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
