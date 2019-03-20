<?php

use yii\db\Migration;
use League\Csv\Reader;
use app\models\LevelJabatan;

/**
 * Class m181117_092220_golongan
 */
class m181117_092220_golongan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'tb_m_golongan',
            [
            'id_golongan' => $this->primaryKey(),
            'kode_golongan' => $this->string(100)->notNull(),
            'nama_golongan' => $this->string(100)->notNull(),
            'nilai_jabatan' => $this->decimal(19, 2)->notNull(),
            'ikkd' => $this->decimal(19, 2)->notNull(),
            'tpp_dinamis' => $this->decimal(19, 2)->notNull(),
            'tpp_statis' => $this->decimal(19, 2)->notNull(),
        ]
        );

        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/tblmastergolonganruang.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);
        // insert data provinsi kedalam tabel provinsi
        //cek max_allowed_packet di my.ini
        $Rows = array();
        foreach ($reader as $index => $row) {
            if (substr($row[2], 0, 2) == 'IV') {
                $lvl = 7;
            } elseif (substr($row[2], 0, 3) == 'III') {
                $lvl=6;
            } else {
                $lvl =5;
            }

            $levelJabatan =   LevelJabatan::find()->where("kelas_level_jabatan=$lvl")->one();
            array_push(
                $Rows,
                [
            $row[0],
             $row[2],
             $row[3],
             $levelJabatan->nilai_jabatan,
             $levelJabatan->ikkd,
             $levelJabatan->tpp_statis,
             $levelJabatan->tpp_dinamis
              ]
        );
        }
        $this->batchInsert('tb_m_golongan', ['id_golongan','kode_golongan', 'nama_golongan', 'nilai_jabatan', 'ikkd', 'tpp_statis', 'tpp_dinamis'], $Rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181117_092220_golongan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181117_092220_golongan cannot be reverted.\n";

        return false;
    }
    */
}
