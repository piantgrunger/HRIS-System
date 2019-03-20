<?php

use yii\db\Migration;

use League\Csv\Reader;

/**
 * Class m181204_104914_update
 */
class m181204_104914_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn("tb_m_pegawai", "nik", $this->string(100));
        $this->alterColumn("tb_m_pegawai", "nip", $this->string(100));

        $source = Yii::getAlias('@app/migrations/tblidentitaspegawai.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);

        foreach ($reader as $index => $data) {
            $this->execute("update tb_m_pegawai set nip='".$data[47]. "',nik='" . $data[53] . "' where id_pegawai=".$data[0]);
            echo $data[47];
        }
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181204_104914_update cannot be reverted.\n";

        return false;
    }
    */
}
