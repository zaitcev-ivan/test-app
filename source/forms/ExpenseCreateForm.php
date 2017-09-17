<?php

namespace app\source\forms;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\source\entities\Category;
use Yii;

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
            [['category_id'], 'integer'],
            [['amount','created_at'], 'safe']
        ];
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->where(['user_id'=>Yii::$app->user->id])->asArray()->all(), 'id', 'name');
    }

    public function attributeLabels()
    {
        return [
            'id' => '#id',
            'category_id' => 'Категория',
            'created_at' => 'Дата создания',
            'amount' => 'Сумма расхода',
        ];
    }
}