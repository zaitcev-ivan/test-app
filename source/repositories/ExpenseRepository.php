<?php

namespace app\source\repositories;

use app\source\entities\Expense;

class ExpenseRepository
{
    public function get($id): Expense
    {
        if (!$expense = Expense::findOne($id)) {
            throw new NotFoundException('Расход не найден');
        }
        return $expense;
    }

    public function save(Expense $expense): void
    {
        if (!$expense->save()) {
            throw new \RuntimeException('Ошибка сохранения расхода');
        }
    }

    public function remove(Expense $expense): void
    {
        if (!$expense->delete()) {
            throw new \RuntimeException('Ошибка удаления расхода');
        }
    }

    private function getBy(array $condition): Expense
    {
        /* @var $expense \app\source\entities\Expense */

        if (!$expense = Expense::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('Расход не найден');
        }
        return $expense;
    }
}