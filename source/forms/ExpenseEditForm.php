<?php

namespace app\source\forms;

use Yii;
use yii\base\Model;
use app\source\entities\Expense;
use app\source\entities\Category;
use yii\helpers\ArrayHelper;

class ExpenseEditForm extends Model
{

    public $category_id;
    public $amount;
    public $created_at;

    private $_expense;

    public function __construct(Expense $expense, array $config = [])
    {

        $this->category_id = $expense->category_id;
        $this->amount = $expense->amount;
        $this->created_at = date('d-m-Y', $expense->created_at);

        $this->_expense = $expense;

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['category_id','amount','created_at'], 'required'],
            [['category_id'], 'integer'],
            [['amount','created_at'], 'safe']
        ];
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->where(['user_id'=>Yii::$app->user->id])->asArray()->all(), 'id', 'name');
    }
}