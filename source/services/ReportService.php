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

    public function selectAllMonth($userId)
    {
        $user = $this->users->get($userId);
        $months = $this->expenses->getAllMonthsByUser($user->id);

        return $months;
    }

    public function createDetailReport($month, $userId)
    {
        $report = [];
        $user = $this->users->get($userId);
        $categories = $this->categories->getByUser($user->id);
        $expenses = $this->expenses->getAllByUserByDay($user->id,$month);
        $categorySum = [];
        $categoryHead = [];
        $categoryHeadEnable = true;
        foreach($expenses as $expense)
        {
            $row = [];
            $rowSum = 0;
            foreach($categories as $category)
            {
                $row[$category->id] = $this->expenses->getByCategory($user->id,$category->id,$expense->group_date);
                $rowSum += $row[$category->id];
                $categorySum[$category->id] += $row[$category->id];
                if($categoryHeadEnable) {
                    $categoryHead[] = $category->name;
                }
            }
            $categoryHeadEnable = false;
            $row['Итого'] = $rowSum;
            $report[$expense->group_date] = $row;
        }
        $categorySum[] = array_sum($categorySum);
        $report['Итого'] = $categorySum;
        $reportResult = [
            'month' => $month,
            'data' => $report,
            'head' => $categoryHead,
        ];
        return $reportResult;
    }
}