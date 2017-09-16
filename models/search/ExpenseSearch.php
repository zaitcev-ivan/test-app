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
    public $created_at;


    public function rules()
    {
        return [
            [['id','category_id','created_at'], 'integer'],
            [['amount'], 'string']
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
            'created_at' => $this->created_at,
            'amount' => $this->amount,
        ]);

        $query->orderBy('created_at DESC');

        return $dataProvider;
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->where(['user_id'=>Yii::$app->user->id])->asArray()->all(), 'id', 'name');
    }

}