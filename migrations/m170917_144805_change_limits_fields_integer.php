<?php

use yii\db\Migration;

class m170917_144805_change_limits_fields_integer extends Migration
{
    public function safeUp()
    {
        $this->dropTable('limits');

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('limits', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'date' => $this->string(),
            'limit_sum' => $this->float()->notNull(),
            'current_sum' => $this->float()->notNull()
        ], $tableOptions);

        $this->createIndex('{{%idx-limits-user_id}}', '{{%limits}}', 'user_id');
        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('{{%fk-limits-user_id}}', '{{%limits}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
        }
    }

    public function safeDown()
    {
        $this->dropTable('limits');
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('limits', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'date' => $this->string(),
            'limit_sum' => $this->integer()->notNull(),
            'current_sum' => $this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('{{%idx-limits-user_id}}', '{{%limits}}', 'user_id');
        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('{{%fk-limits-user_id}}', '{{%limits}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
        }
    }
}
