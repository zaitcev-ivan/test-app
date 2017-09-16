<?php

namespace app\source\services;

use app\source\entities\Category;
use app\source\entities\Expense;
use app\source\forms\ExpenseCreateForm;
use app\source\forms\ExpenseEditForm;
use app\source\repositories\ExpenseRepository;
use app\source\repositories\CategoryRepository;
use app\source\repositories\UserRepository;

class ExpenseService
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

    public function create(ExpenseCreateForm $form, $userId): void
    {
        $category = $this->categories->get($form->category_id);
        $user = $this->users->get($userId);
        $this->checkUsersCategory($category, $user->id);
        $expense = Expense::create($user->id,$category->id,$form->created_at,$form->amount);

        $this->expenses->save($expense);
    }

    public function edit(ExpenseEditForm $form, $expenseId, $userId): void
    {
        $expense = $this->expenses->get($expenseId);
        $category = $this->categories->get($form->category_id);
        $user = $this->users->get($userId);
        $this->checkUsersCategory($category, $user->id);

        $expense->edit($category->id,$form->created_at,$form->amount);
        $this->expenses->save($expense);
    }

    protected function checkUsersCategory(Category $category, $userId): void
    {
        if(!$category->isUserAssign($userId)) {
            throw new \DomainException('Ошибка в выборе категории расхода');
        }
    }
}