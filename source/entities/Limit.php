<?php

namespace app\source\entities;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Class Limit
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property float $limit_sum
 * @property float $current_sum
 *
 * @property User $user
 */
class Limit extends ActiveRecord
{

    public static function create($userId, $date, $limitSum, $currentSum): self
    {
        $limit = new static();
        $limit->user_id = $userId;
        $limit->date = $date;
        $limit->limit_sum = $limitSum;
        $limit->current_sum = $currentSum;
        return $limit;
    }

    public static function tableName()
    {
        return '{{%limits}}';
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}