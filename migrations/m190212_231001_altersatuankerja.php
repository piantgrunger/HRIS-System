<?php

use yii\db\Migration;

/**
 * Class m190212_231001_altersatuankerja
 */
class m190212_231001_altersatuankerja extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_satuan_kerja', 'checklog_key', $this->string(200));
        $this->execute('update tb_m_satuan_kerja set checklog_key=md5(nama_satuan_kerja)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190212_231001_altersatuankerja cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190212_231001_altersatuankerja cannot be reverted.\n";

        return false;
    }
    */
}
