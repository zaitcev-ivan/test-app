<?php

namespace app\source\forms;

use yii\base\Model;

class CategoryCreateForm extends Model
{

    public $name;

    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'string', 'max' => 255],
        ];
    }
}