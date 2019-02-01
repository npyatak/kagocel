<?php

use yii\db\Migration;

class m181020_092216_create_table_stage extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%stage}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            
            'date_start' => $this->integer()->notNull(),
            'date_end' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->batchInsert('{{%stage}}', ['number', 'date_start', 'date_end', 'name'], [
            [1, strtotime('2019-03-04 00:00:00'), strtotime('2019-03-10 23:59:59'), 'Первый этап'],
            [2, strtotime('2019-03-11 00:00:00'), strtotime('2019-03-17 23:59:59'), 'Второй этап'],
            [3, strtotime('2019-03-18 00:00:00'), strtotime('2019-03-24 23:59:59'), 'Третий этап'],
            [4, strtotime('2019-03-25 00:00:00'), strtotime('2019-03-31 23:59:59'), 'Четвертый этап'],
            [5, time(), strtotime('2019-03-04 00:00:00'), 'Тест'],
        ]);
    }

    public function safeDown() {
        $this->dropTable('{{%stage}}');
    }
}