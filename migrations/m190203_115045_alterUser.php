<?php

use yii\db\Migration;
use app\models\Pegawai;

/**
 * Class m190203_115045_alterUser
 */
class m190203_115045_alterUser extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = Pegawai::find()
                 ->innerJoin('user', 'tb_m_pegawai.id_pegawai = user.id_pegawai')
                 ->where('tb_m_pegawai.nip <> user.username ')
                 ->all();
        foreach ($data as $model) {
            $this->execute("update user set username= '".$model->nip. "',password_hash=   '". Yii::$app->security->generatePasswordHash($model->nip, 10)."' where id_pegawai= ".$model->id_pegawai);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190203_115045_alterUser cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190203_115045_alterUser cannot be reverted.\n";

        return false;
    }
    */
}
