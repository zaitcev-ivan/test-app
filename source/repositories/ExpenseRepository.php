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

    public function getAllByUserByMonth($userId): array
    {
        if (!$expense = Expense::find()
            ->select(['strftime("%m-%Y", datetime(created_at, \'unixepoch\', \'localtime\')) as group_date, SUM(amount) as amount'])
            ->groupBy ('group_date')
            ->andWhere(['user_id' => $userId])
            ->orderBy('created_at DESC')
            ->all()
        )
        {
            throw new NotFoundException('Расходы не найдены');
        }
        return $expense;
    }

    public function getAllByUserByDay($userId, $month): array
    {
        if (!$expense = Expense::find()
            ->select(['strftime("%d-%m-%Y", datetime(created_at, \'unixepoch\', \'localtime\')) as group_date, SUM(amount) as amount'])
            ->groupBy ('group_date')
            ->andWhere(['strftime("%m-%Y", datetime(created_at, \'unixepoch\', \'localtime\'))' => $month])
            ->andWhere(['user_id' => $userId])
            ->orderBy('created_at DESC')
            ->all()
        )
        {
            throw new NotFoundException('Расходы не найдены');
        }
        return $expense;
    }

    public function getAllMonthsByUser($userId): array
    {
        if (!$expense = Expense::find()
            ->select(['strftime("%m-%Y", datetime(created_at, \'unixepoch\', \'localtime\')) as group_date'])
            ->groupBy ('group_date')
            ->andWhere(['user_id' => $userId])
            ->orderBy('created_at DESC')
            ->all()
        )
        {
            throw new NotFoundException('Расходы не найдены');
        }
        return $expense;
    }

    public function getByCategory($userId,$categoryId,$date)
    {
        $amount = 0;
        /* @var $expense \app\source\entities\Expense */
        if($expense = Expense::find()
            ->select(['strftime("%d-%m-%Y", datetime(created_at, \'unixepoch\', \'localtime\')) as group_date, SUM(amount) as amount'])
            ->groupBy ('group_date')
            ->andWhere(['strftime("%d-%m-%Y", datetime(created_at, \'unixepoch\', \'localtime\'))' => $date])
            ->andWhere(['user_id' => $userId])
            ->andWhere(['category_id' => $categoryId])
            ->limit(1)
            ->one()
        )
        {
            $amount = $expense->amount;
        }
        return $amount;
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