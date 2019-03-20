<?php

use yii\db\Migration;

/**
 * Class m181117_204558_alterjabatan
 */
class m181117_204558_alterjabatan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
          $this->addColumn('tb_m_jabatan_fungsional', 'id_eselon', $this->integer());
      $this->addForeignKey(
            'fk_jabatan_eselon',
        'tb_m_jabatan_fungsional',
        'id_eselon',
        'tb_m_eselon',
        'id_eselon'
    );



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181117_204558_alterjabatan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181117_204558_alterjabatan cannot be reverted.\n";

        return false;
    }
    */
}
