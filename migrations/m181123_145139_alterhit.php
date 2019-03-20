<?php

use yii\db\Migration;

/**
 * Class m181123_145139_alterhit
 */
class m181123_145139_alterhit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            'fk_ht_uk',
            'tb_mt_hitung_tunjangan'

        );
        $this->dropColumn('tb_mt_hitung_tunjangan', 'id_unit_kerja');
        $this->addColumn('tb_mt_hitung_tunjangan', 'id_satuan_kerja', $this->integer());
        $this->addForeignKey(
            'fk_ht_sk',
            'tb_mt_hitung_tunjangan',
            'id_satuan_kerja',
            'tb_m_satuan_kerja',
            'id_satuan_kerja',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181123_145139_alterhit cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181123_145139_alterhit cannot be reverted.\n";

        return false;
    }
    */
}
