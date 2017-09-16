<?php

use yii\db\Migration;

/**
 * Handles the creation of table `expenses`.
 */
class m170916_094346_create_expense_table extends Migration
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
        $this->createTable('expenses', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'amount' => $this->float()->notNull(),
        ], $tableOptions);
        $this->createIndex('{{%idx-expenses-user_id}}', '{{%expenses}}', 'user_id');
        $this->createIndex('{{%idx-expenses-category_id}}', '{{%expenses}}', 'category_id');
        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('{{%fk-expenses-user_id}}', '{{%expenses}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
            $this->addForeignKey('{{%fk-expenses-category_id}}', '{{%expenses}}', 'category_id', '{{%categories}}', 'id', 'CASCADE');
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('expenses');
    }
}
