<?php

namespace app\source\services;

use app\source\repositories\ExpenseRepository;
use app\source\repositories\CategoryRepository;
use app\source\repositories\UserRepository;

class ReportService
{
    private $expenses;
    private $categories;
    private $users;

    public function __construct(
        ExpenseRepository $expenses,
        CategoryRepository $categories,
        UserRepository $users
    )
    {
        $this->expenses = $expenses;
        $this->categories = $categories;
        $this->users = $users;
    }

    public function createMonthlyReport($userId)
    {
        $report = [];
        $user = $this->users->get($userId);
        $expenses = $this->expenses->getAllByUserByMonth($user->id);

        foreach($expenses as $expense)
        {
            $report[] = [
                'key' => $expense->group_date,
                'value' => $expense->amount
            ];
        }
        return $report;
    }
}