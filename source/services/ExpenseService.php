<?php

namespace app\source\services;

use app\source\entities\Category;
use app\source\entities\Expense;
use app\source\entities\Limit;
use app\source\forms\ExpenseCreateForm;
use app\source\forms\ExpenseEditForm;
use app\source\repositories\ExpenseRepository;
use app\source\repositories\CategoryRepository;
use app\source\repositories\SettingsRepository;
use app\source\repositories\UserRepository;
use app\source\repositories\LimitRepository;

class ExpenseService
{
    private $expenses;
    private $categories;
    private $users;
    private $limits;
    private $settings;
    private $transaction;

    public function __construct(
        ExpenseRepository $expenses,
        CategoryRepository $categories,
        UserRepository $users,
        LimitRepository $limits,
        SettingsRepository $settings,
        TransactionManager $transaction
    )
    {
        $this->expenses = $expenses;
        $this->categories = $categories;
        $this->users = $users;
        $this->limits = $limits;
        $this->settings = $settings;
        $this->transaction = $transaction;
    }

    public function create(ExpenseCreateForm $form, $userId): void
    {
        $category = $this->categories->get($form->category_id);
        $user = $this->users->get($userId);
        $settings = $this->settings->getByUserId($user->id);
        $this->checkUsersCategory($category, $user->id);
        $expense = Expense::create($user->id,$category->id,$form->created_at,$form->amount);
        if(!$limit = $this->limits->getByUserAndDate($user->id,$form->created_at)) {
            $limit = Limit::create($user->id,$form->created_at, $settings->limit_sum,0);
        }
        $limit->addAmount($form->amount);

        $this->transaction->wrap(function () use ($limit, $expense) {
            $this->expenses->save($expense);
            $this->limits->save($limit);
        });
    }

    public function edit(ExpenseEditForm $form, $expenseId, $userId): void
    {
        $expense = $this->expenses->get($expenseId);
        $category = $this->categories->get($form->category_id);
        $user = $this->users->get($userId);
        $this->checkUsersCategory($category, $user->id);
        $this->transaction->wrap(function () use ($expense, $user, $category, $form) {
            /* @var Limit $oldLimit */
            $oldLimit = $this->limits->getByUserAndDate($user->id, date("d-m-Y",$expense->created_at));
            $oldLimit->removeAmount($expense->amount);
            $this->limits->save($oldLimit);
            /* @var Limit $newLimit */
            $newLimit = $this->limits->getByUserAndDate($user->id,$form->created_at);
            $newLimit->addAmount($form->amount);
            $this->limits->save($newLimit);

            $expense->edit($category->id, $form->created_at, $form->amount);

            $this->expenses->save($expense);
        });
    }

    public function remove($expenseId): void
    {
        $expense = $this->expenses->get($expenseId);
        /* @var Limit $limit */
        $limit = $this->limits->getByUserAndDate($expense->user_id,date("d-m-Y",$expense->created_at));
        $limit->removeAmount($expense->amount);
        $this->transaction->wrap(function () use ($limit, $expense) {
            $this->limits->save($limit);
            $this->expenses->remove($expense);
        });
    }

    protected function checkUsersCategory(Category $category, $userId): void
    {
        if(!$category->isUserAssign($userId)) {
            throw new \DomainException('Ошибка в выборе категории расхода');
        }
    }
}