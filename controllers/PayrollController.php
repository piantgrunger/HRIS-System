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

class PayrollController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, null);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
   
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) ) {

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailPayrollTunjangan = Yii::$app->request->post('DetPayrollTunjangan', []);
                $model->detailPayrollPotongan = Yii::$app->request->post('DetPayrollPotongan', []);
                if (($model->save())) {
                    $transaction->commit();
                    return $this->redirect(['index']);
                }
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
            return $this->render('update', [
                'model' => $model,
            ]);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    protected function findModel($id)
    {
        if (($model = Pegawai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
