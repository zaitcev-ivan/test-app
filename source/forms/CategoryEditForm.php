<?php

namespace app\source\forms;

use yii\base\Model;
use app\source\entities\Category;

class CategoryEditForm extends Model
{

    public $name;

    private $_category;

    public function __construct(Category $category, array $config = [])
    {

        $this->name = $category->name;

        $this->_category = $category;

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
        ];
    }
}