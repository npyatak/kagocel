<?php

use yii\db\Migration;

class m180822_115335_create_table_user extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->unique()->comment('E-mail'),
            'password' => $this->string()->comment('Пароль'),
            'phone' => $this->string()->comment('Телефон'),
            'soc' => $this->string(2)->comment('Соц.сеть'),
            'sid' => $this->bigInteger()->comment('ID соц.сети'),
            'name' => $this->string()->comment('Имя'),
            'surname' => $this->string()->comment('Фамилия'),
            'image' => $this->string()->comment('Изображение'),
            'status' => $this->integer(1)->notNull()->defaultValue(1)->comment('Статус'),
            'ip' => $this->string()->comment('IP'),
            'browser' => $this->string()->comment('Браузер'),
            'birthdate' => $this->bigInteger()->comment('Дата рождения'),

            'created_at' => $this->integer()->notNull()->comment('Создано'),
            'updated_at' => $this->integer()->notNull()->comment('Обновлено'),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable('{{%user}}');
    }
}
