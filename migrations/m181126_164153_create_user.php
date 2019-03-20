<?php

use yii\db\Migration;
use app\models\User;
use League\Csv\Reader;

/**
 * Class m181126_164153_create_user.
 */
class m181126_164153_create_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function in_array_r($item, $array)
    {
        return preg_match('/"'.preg_quote($item, '/').'"/i', json_encode($array));
    }

    public function safeUp()
    {
        $source = Yii::getAlias('@app/migrations/tblidentitaspegawai.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);

        $row = [];
        foreach ($reader as $index => $data) {
            if (!$this->in_array_r($data[47], $row)) {
                // found!

                array_push(
                $row,
                [
             $data[47],
             Yii::$app->security->generatePasswordHash($data[47], 10),
                    $data[47],

            $data[0],
                ]
             );
                echo $data[47];
            }
        }
        try {
            $this->batchInsert('user', ['username', 'password_hash', 'email', 'id_pegawai'], $row);
        } catch (Exception $ex) {
            echo 'Query failed '.substr($ex->getMessage(), 1, 1000);

            return false;
        }
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
        echo "m181126_164153_create_user cannot be reverted.\n";

        return false;
    }
    */
}
