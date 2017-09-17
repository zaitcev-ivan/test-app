<?php

use yii\db\Migration;

/**
 * Handles the creation of table `settings`.
 */
class m170917_051042_create_settings_table extends Migration
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
        $this->createTable('settings', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'limit_sum' => $this->integer()->unsigned()->notNull(),
            'scenario' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('settings');
    }
}
