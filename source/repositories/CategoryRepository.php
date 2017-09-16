<?php

namespace app\source\repositories;

use app\source\entities\Category;

class CategoryRepository
{
    public function get($id): Category
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundException('Категория не найдена');
        }
        return $category;
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('Ошибка сохранения категории');
        }
    }

    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Ошибка удаления категории');
        }
    }

    private function getBy(array $condition): Category
    {
        /* @var $category \app\source\entities\Category*/

        if (!$category = Category::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('Категория не найдена');
        }
        return $category;
    }
}