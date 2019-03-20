<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m190101_035017_alterunitkerja
 */
class m190101_035017_alterunitkerja extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_unit_kerja', 'id_satuan_kerja', $this->integer());
        $source = Yii::getAlias('@app/migrations/tblmasterunitkerja.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);
        // insert data provinsi kedalam tabel provinsi
        //cek max_allowed_packet di my.ini
        foreach ($reader as $index => $row) {
            $this->execute("update tb_m_unit_kerja set id_satuan_kerja=$row[2] where id_unit_kerja=$row[0]");
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
        echo "m190101_035017_alterunitkerja cannot be reverted.\n";

        return false;
    }
    */
}
