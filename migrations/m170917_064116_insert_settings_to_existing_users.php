<?php

use yii\db\Migration;
use app\source\entities\User;

class m170917_064116_insert_settings_to_existing_users extends Migration
{
    public function safeUp()
    {
        $users = User::find()->select('id')->all();
        /* @var User $user */
        foreach($users as $user)
        {
            $this->batchInsert('settings', ['user_id', 'limit_sum', 'scenario'], [
                [$user->id, Yii::$app->params['settings.limitSum'], Yii::$app->params['settings.scenario']],
            ]);
        }
    }

    public function safeDown()
    {
        $this->delete('settings');
    }
}
