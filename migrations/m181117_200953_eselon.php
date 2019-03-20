<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m181117_200953_eselon
 */
class m181117_200953_eselon extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable(
            'tb_m_eselon',
            [
            'id_eselon' => $this->primaryKey(),
            'nama_eselon' => $this->string(100)->notNull(),
        ]
        );

        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/tblmastereselon.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);
        // insert data provinsi kedalam tabel provinsi
        //cek max_allowed_packet di my.ini
        $Rows = array();
        foreach ($reader as $index => $row) {
           array_push(
                $Rows,
                [
            $row[0],
             $row[3],
              ]
        );
        }
        $this->batchInsert('tb_m_eselon', ['id_eselon','nama_eselon'], $Rows);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181117_200953_eselon cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181117_200953_eselon cannot be reverted.\n";

        return false;
    }
    */
}
