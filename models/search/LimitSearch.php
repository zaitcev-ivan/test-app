<?php

namespace app\models\search;

use app\source\entities\Limit;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\source\entities\Expense;
use yii\helpers\ArrayHelper;

/**
 * LimitSearch represents the model behind the search form about `app\source\entities\Limit`.
 */
class LimitSearch extends Model
{

    public $id;
    public $current_sum;
    public $limit_sum;
    public $date;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['limit_sum', 'current_sum'], 'safe'],
            [['date'],'date','format' => 'php:Y-m'],
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
        $query = Limit::find()->where(['user_id' => Yii::$app->user->id]);

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
            'limit_sum' => $this->limit_sum,
            'current_sum' => $this->current_sum,
        ]);

        $query->orderBy('date DESC');

        return $dataProvider;
    }

}