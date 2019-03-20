<?php

use yii\db\Migration;

/**
 * Class m180916_110246_alter_jabatan_fung.
 */
class m180916_110246_alter_jabatan_fung extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'tb_m_jabatan_fungsional',
             'besaran_tpp',
             $this->decimal(19, 2)
         );

        $this->addColumn(
            'tb_m_jabatan_fungsional',
           'tambahan_tunjangan_kinerja',
           $this->decimal(19, 2)
       );
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
        echo "m180916_110246_alter_jabatan_fung cannot be reverted.\n";

        return false;
    }
    */
}
