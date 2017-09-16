<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m170916_074602_create_category_table extends Migration
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

        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(),
        ], $tableOptions);

        $this->createIndex('{{%idx-categories-user_id}}', '{{%categories}}', 'user_id');
        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('{{%fk-categories-user_id}}', '{{%categories}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('categories');
    }
}
