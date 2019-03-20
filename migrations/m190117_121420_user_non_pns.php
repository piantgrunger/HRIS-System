<?php

use yii\db\Migration;
use app\models\Pegawai;

/**
 * Class m190117_121420_user_non_pns
 */
class m190117_121420_user_non_pns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("update tb_m_pegawai set nip=replace(nip,' ','')  where nip like '% %'");
        $this->execute("update tb_m_pegawai set nip=replace(nip,'.','')  where nip like '%.%'");
        $this->execute("delete from user where `username` = '' ");

        $pegawai = Pegawai::find()->where("jenis_pegawai <>'Pegawai Negeri Sipil' and coalesce(nip,'')<>'' ")->all();
        $row = [];
        foreach ($pegawai as $data) {
            //     if (!$this->in_array_r($data[47], $row)) {
            // found!

            array_push(
                $row,
                [
                    $data->nip,
                    Yii::$app->security->generatePasswordHash($data->nip, 10),
                    $data->nip,

                    $data->id_pegawai,
                ]
            );
            echo $data->nip;
            //    }
        }

        //   $this->batchInsert('user', ['username', 'password_hash', 'email', 'id_pegawai'], $row);
        $sql = $this->db->createCommand()->batchInsert('user', ['username', 'password_hash', 'email', 'id_pegawai'], $row)-> getRawSql();
        echo $sql;
        $this->execute($sql . ' ON DUPLICATE KEY UPDATE USERNAME =VALUES(USERNAME)');
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
        echo "m190117_121420_user_non_pns cannot be reverted.\n";

        return false;
    }
    */
}
