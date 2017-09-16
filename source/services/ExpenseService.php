<?php

namespace app\source\services;

use app\source\entities\Expense;
use app\source\forms\ExpenseCreateForm;
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

        $expense = Expense::create($user->id,$category->id,$form->created_at,$form->amount);

        $this->expenses->save($expense);
    }
}