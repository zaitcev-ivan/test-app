<?php

namespace app\source\entities;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use app\source\services\dto\SettingsDto;

/**
 * Class Settings
 *
 * @property integer $id
 * @property integer $limit_sum
 * @property integer $scenario
 * @property integer $user_id
 *
 * @property User $user
 */
class Settings extends ActiveRecord
{
    public static function create(SettingsDto $dto, $userId): self
    {
        $settings = new static();
        $settings->limit_sum = $dto->limitSum;
        $settings->scenario = $dto->scenario;
        $settings->user_id = $userId;

        return $settings;
    }

    public function editLimitSum($limitSum)
    {
        $this->limit_sum = $limitSum;
    }

    public function editScenario($scenario)
    {
        $this->scenario = $scenario;
    }

    public static function tableName()
    {
        return '{{%settings}}';
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}