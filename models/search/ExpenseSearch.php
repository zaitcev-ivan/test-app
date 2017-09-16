<?php

namespace app\models\search;

use app\source\entities\Category;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\source\entities\Expense;
use yii\helpers\ArrayHelper;

/**
 * ExpenseSearch represents the model behind the search form about `app\source\entities\Expense`.
 */
class ExpenseSearch extends Model
{

    public $id;
    public $category_id;
    public $amount;
    public $date_from;
    public $date_to;


    public function rules()
    {
        return [
            [['id','category_id'], 'integer'],
            [['amount'], 'string'],
            [['date_from', 'date_to'],'date','format' => 'php:Y-m-d'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Expense::find()->where(['user_id' => Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);

        $query->orderBy('created_at DESC');

        return $dataProvider;
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->where(['user_id'=>Yii::$app->user->id])->asArray()->all(), 'id', 'name');
    }

}