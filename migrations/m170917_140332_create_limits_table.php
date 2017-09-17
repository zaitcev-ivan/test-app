<?php

use yii\db\Migration;

/**
 * Handles the creation of table `limits`.
 */
class m170917_140332_create_limits_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
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

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('limits');
    }
}
