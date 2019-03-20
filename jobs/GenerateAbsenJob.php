<?php
namespace app\jobs;

use Yii;
use yii\queue\JobInterface;
use yii\base\BaseObject;
use app\models\HitungTunjangan;

class GenerateAbsenJob extends BaseObject implements JobInterface
{
    public $tgl_awal;
    public $tgl_akhir;
    public $id_satuan_kerja;
    public $id;

    public function execute($queue)
    {
        $connection=   Yii::$app->getDb();
        $command = $connection->createCommand("call `generate_absen`('$this->tgl_awal', '$this->tgl_akhir', '$this->id_satuan_kerja')") ;
        $command->execute();
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("call `hitung_tunjangan`('$this->tgl_awal', '$this->tgl_akhir', '$this->id_satuan_kerja', '$this->id')");
        $command->execute();
    }
}
