<?php

namespace app\source\entities;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Class Expense
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $created_at
 * @property float $amount
 *
 * @property User $user
 * @property Category $category
 */
class Expense extends ActiveRecord
{

    public static function create($userId, $categoryId, $createdAt, $amount): self
    {
        $expense = new static();
        $expense->user_id = $userId;
        $expense->category_id = $categoryId;
        $expense->created_at = $expense->convertDate($createdAt);
        $expense->amount = $expense->convertToFloat($amount);

        return $expense;
    }

    public function edit($categoryId, $createdAt, $amount)
    {
        $this->category_id = $categoryId;
        $this->created_at = $this->convertDate($createdAt);
        $this->amount = $this->convertToFloat($amount);
    }

    public function convertDate($date)
    {
        return strtotime($date);
    }

    public function convertToFloat($amount)
    {
        return (float)$amount;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%expenses}}';
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}