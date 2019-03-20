<?php

use yii\db\Migration;

/**
 * Class m181207_010508_alterpeg.
 */
class m181207_010508_alterpeg extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_pegawai', 'jenis_pegawai', $this->string(50)->notNull()->defaultValue('Pegawai Negeri Sipil'));
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
        echo "m181207_010508_alterpeg cannot be reverted.\n";

        return false;
    }
    */
}
