<?php

namespace app\controllers;

use Yii;
use app\models\Ijin;
use app\models\Absen;
use app\models\IjinSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\widgets\InboxWidget;

/**
 * IjinController implements the CRUD actions for Ijin model.
 */
class IjinController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Ijin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IjinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ijin model.
     * @param integer $id
     * @return mixed
     */
    public function actionBatalValidasi($id)
    {
        $model = $this->findModel($id);
        $model->status ="Belum Divalidasi";
        $model->save();
        $absen = Absen::find()->where(["id_pegawai"=>$model->id_pegawai,"tgl_absen"=>$model->tgl_absen])->one();
        $jenisAbsen = \app\models\JenisAbsen::find()->where("nama_jenis_absen='Tanpa Keterangan'")->one();
        if ($absen) {
            $absen->id_jenis_absen=$jenisAbsen->id_jenis_absen;
            $absen->tgl_absen= implode('-', array_reverse(explode('-', $model->tgl_absen)));
            $absen->masuk_kerja = $absen->masuk_kerja;
            $absen->pulang_kerja = $absen->pulang_kerja;

            $absen->alasan="Ijin / cuti yang diajukan ditolak ";


            $absen->save();
        }
        InboxWidget::run();

        return $this->redirect('index');
    }

    public function actionValidasi($id)
    {
        $model = $this->findModel($id);


        $absen = Absen::find()->where(["id_pegawai"=>$model->id_pegawai,"tgl_absen"=>$model->tgl_absen])->one();
        $jenisAbsen = \app\models\JenisAbsen::find()->where("nama_jenis_absen='Tanpa Keterangan'")->one();
        if (is_null($absen)) {
            $absen=new Absen;
            $absen->tgl_absen= implode('-', array_reverse(explode('-', $model->tgl_absen)));
            $absen->alasan=$model->alasan;
            $absen->masuk_kerja = "00:00";
            $absen->pulang_kerja = "00:00";
        }
        {
            $absen->id_jenis_absen=$model->id_jenis_absen;
            $absen->tgl_absen= implode('-', array_reverse(explode('-', $model->tgl_absen)));
            $absen->alasan=$model->alasan;
            $absen->terlambat_kerja = 0;
            $absen->pulang_awal = 0;


            $absen->save(false);

        }
        Yii::$app->db->createCommand("update tb_mt_ijin set status ='Sudah Divalidasi' where id_ijin=$id")->execute();
        InboxWidget::run();
        return $this->redirect('index');
    }

    public function actionMultipleDelete()
    {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) {
            $this->findModel($value)->delete();
        }

        return $this->redirect(['index']);
    }
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (\yii\db\IntegrityException  $e) {
            Yii::$app->session->setFlash('error', "Data Tidak Dapat Dihapus Karena Dipakai Modul Lain");
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Ijin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ijin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ijin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
