<?php

namespace app\source\services;

use app\source\repositories\CategoryRepository;

class CategoryService
{
    private $categories;

    public function __construct(
        CategoryRepository $categories
    )
    {
        $this->categories = $categories;
    }
}