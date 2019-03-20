<?php

use yii\db\Migration;
use app\models\Pegawai;

/**
 * Class m190203_125638_createuserbaru
 */
class m190203_125638_createuserbaru extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("update user  u
                                         inner join tb_m_pegawai p on u.username = p.nip
                                         set u.id_pegawai = p.id_pegawai
                                         where u.id_pegawai is null
                                         ");

        $model = Pegawai::find()
                       ->leftJoin("user", "user.id_pegawai = tb_m_pegawai.id_pegawai")
                       ->where("user.id_pegawai is null and jenis_pegawai='Pegawai Negeri Sipil'")
                       ->all();

        $row = [];
        foreach ($model as $data) {
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
        }
        try {
            $this->batchInsert('user', ['username', 'password_hash', 'email', 'id_pegawai'], $row);
        } catch (Exception $ex) {
            echo 'Query failed ' . substr($ex->getMessage(), 1, 1000);

            return false;
        }
        $this->execute(" insert into auth_assignment select 'PNS',id,1111 from user u
                                   left join auth_assignment a on a.user_id = u.id

        where id >1 and a.user_id is null and id_pegawai is not null ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190203_125638_createuserbaru cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190203_125638_createuserbaru cannot be reverted.\n";

        return false;
    }
    */
}
