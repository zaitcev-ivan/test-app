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
        $limit->date = date("m-Y",strtotime($date));
        $limit->limit_sum = $limitSum;
        $limit->current_sum = $currentSum;
        return $limit;
    }

    public function addAmount($amount)
    {
        $this->current_sum += $amount;
    }

    public function removeAmount($amount)
    {
        $this->current_sum -= $amount;
        if($this->current_sum < 0) {
            $this->current_sum = 0;
        }
    }

    public function editLimit($amount)
    {
        if($amount > 0) {
            $this->limit_sum = $amount;
        }
    }

    public function decLimit($amount)
    {
        $this->limit_sum -= $amount;
        if($this->limit_sum < 0) {
            $this->limit_sum = 0;
        }
    }

    public function isOverflow(): bool
    {
        return $this->current_sum > $this->limit_sum;
    }

    public function getOverflowSum()
    {
        return $this->current_sum - $this->limit_sum;
    }

    public function getNextMonth($currentDate)
    {
        $currentDate = strtotime($currentDate);
        $nextDate = mktime(
            date('H',$currentDate),
            date('i',$currentDate),
            date('s',$currentDate),
            date('m',$currentDate)+1,
            date('d',$currentDate),
            date('Y',$currentDate)
        );
        return date("d-m-Y", $nextDate);
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