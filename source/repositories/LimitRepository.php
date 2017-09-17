<?php

namespace app\source\repositories;

use app\source\entities\Limit;

class LimitRepository
{
    public function get($id): Limit
    {
        if (!$limit = Limit::findOne($id)) {
            throw new NotFoundException('Ограничение не найдено');
        }
        return $limit;
    }

    public function getByUser($userId): array
    {
        if (!$limit = Limit::find()->andWhere(['user_id' => $userId])->all()) {
            throw new NotFoundException('Ограничения не найдены');
        }
        return $limit;
    }

    public function getByUserAndDate($userId, $date)
    {
        $date = date("m-Y",strtotime($date));
        return Limit::find()->andWhere(['user_id' => $userId,'date' => $date])->limit(1)->one();
    }

    public function save(Limit $limit): void
    {
        if (!$limit->save()) {
            throw new \RuntimeException('Ошибка сохранения ограничений');
        }
    }

    public function remove(Limit $limit): void
    {
        if (!$limit->delete()) {
            throw new \RuntimeException('Ошибка удаления ограничения');
        }
    }

    private function getBy(array $condition): Limit
    {
        /* @var $limit \app\source\entities\Limit*/

        if (!$limit = Limit::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('Категория не найдена');
        }
        return $limit;
    }
}