<?php

namespace app\source\entities;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use app\source\entities\User;

/**
 * Class Category
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 *
 * @property User $user
 */
class Category extends ActiveRecord
{

    public static function create($userId, $name): self
    {
        $category = new static();
        $category->user_id = $userId;
        $category->name  = $name;

        return $category;
    }

    public function edit($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}