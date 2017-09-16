<?php

namespace app\source\forms;

use yii\base\Model;

class ExpenseCreateForm extends Model
{
    public $category_id;
    public $amount;
    public $created_at;

    public function __construct(array $config = [])
    {
        $this->created_at = date('d-m-Y', time());

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['category_id','amount','created_at'], 'required'],
            [['category_id','created_at'], 'integer'],
            [['amount'], 'string']
        ];
    }
}