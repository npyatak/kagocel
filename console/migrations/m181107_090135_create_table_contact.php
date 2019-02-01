<?php

use yii\db\Migration;

class m181107_090135_create_table_contact extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Имя'),
            'email' => $this->string()->comment('E-mail'),
            'phone' => $this->string()->comment('Телефон'),
            'body' => $this->string()->comment('Телефон'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),

            'created_at' => $this->integer()->comment('Время отправки'),
        ], $tableOptions);     
    }

    public function safeDown() {
        $this->dropTable('{{%contact}}');
    }
}
