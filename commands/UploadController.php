<?php
namespace app\commands;

use yii\console\Controller;
use Yii;
use League\Csv\Reader;
use GuzzleHttp\Client;

class UploadController extends Controller
{
    public function actionIndex()
    {
        $source = Yii::getAlias('@app/commands/disdik.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);
        // insert data provinsi kedalam tabel provinsi
        //cek max_allowed_packet di my.ini
        $uri = "http://localhost/bagawai/web/api/absen";
        $client = new Client();
        foreach ($reader as $index => $row) {
            $id_skpd = '28';
            $date = new \DateTime($row[3]);
            $kode_checklog= $row[1];
            $tanggal = $date->format("Y-m-d");
            $waktu= $date->format("H:i");
            $response = $client->request("POST", $uri, [
                 'form_params' => [
                     'tanggal' => $tanggal,
                     'id_skpd' => $id_skpd,
                     'waktu' => $waktu,
                     'kode_checklog' => $kode_checklog,

            ]]);
            echo $response->getBody();
        }
    }
}
