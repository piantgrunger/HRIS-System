<?php

use yii\db\Migration;

/**
 * Class m181122_064759_alterHitTunj
 */
class m181122_064759_alterHitTunj extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_mt_hitung_tunjangan', 'id_unit_kerja', $this->integer());
        $this->addForeignKey(
            'fk_ht_uk',
            'tb_mt_hitung_tunjangan',
            'id_unit_kerja',
            'tb_m_unit_kerja',
            'id_unit_kerja',
            'RESTRICT'
    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181122_064759_alterHitTunj cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181122_064759_alterHitTunj cannot be reverted.\n";

        return false;
    }
    */
}
