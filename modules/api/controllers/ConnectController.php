<?php
namespace app\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use app\models\SatuanKerja;

/**
 * Default controller for the `api` module.
 */
class ConnectController extends Controller
{
    public function actionIndex()
    {
        $post = Yii::$app->request->post('token');

        $model = SatuanKerja::find()->where(['checklog_key' =>$post]) ->one();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($model !== null) {
            $response=["status" => 200,"id"=> $model->id_satuan_kerja,"message" =>$model->nama_satuan_kerja,"tanggal" => $model->tanggal_absen_terakhir];
        } else {
            $response = ["status" => 404, "id" => 0, "message"=>"Koneksi salah Hubungi Administrator"];
        }
        return $response;
    }
}
