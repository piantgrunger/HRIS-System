<?php

use yii\db\Migration;

/**
 * Class m181122_070853_tgl
 */
class m181122_070853_tgl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
                'tp_tanggal',
              [
                  'tanggal' =>$this->date()->notNull(),
              ]
              );
        $this->createIndex('idx_tp_tanggal', 'tp_tanggal', 'tanggal', true);
        $this->execute("
        insert into tp_tanggal
     select d.date from
(select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) date from
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
 (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) d

where d.date between '2018-01-01' and '2022-12-31'
group by d.date
order by d.date ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(
            'tp_tanggal'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181122_070853_tgl cannot be reverted.\n";


        return false;
    }
    */
}
