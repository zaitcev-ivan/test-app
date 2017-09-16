<?php

namespace app\source\services;

use app\source\entities\Category;
use app\source\forms\CategoryEditForm;
use app\source\repositories\CategoryRepository;
use app\source\repositories\UserRepository;
use app\source\forms\CategoryCreateForm;

class CategoryService
{
    private $categories;
    private $users;

    public function __construct(
        CategoryRepository $categories,
        UserRepository $users
    )
    {
        $this->categories = $categories;
        $this->users = $users;
    }

    public function create(CategoryCreateForm $form, $userId): void
    {
        $user = $this->users->get($userId);

        $category = Category::create($user->id,$form->name);
        $this->categories->save($category);
    }

    public function edit(CategoryEditForm $form, $categoryId): void
    {
        $category = $this->categories->get($categoryId);
        $category->edit($form->name);
        $this->categories->save($category);
    }

    public function remove($categoryId): void
    {
        $category = $this->categories->get($categoryId);
        $this->categories->remove($category);
    }
}