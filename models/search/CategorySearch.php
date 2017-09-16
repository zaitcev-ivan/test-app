<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\source\entities\Category;

/**
 * CategorySearch represents the model behind the search form about `app\source\entities\Category`.
 */
class CategorySearch extends Model
{

    public $id;
    public $name;


    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'string'],
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
        $query = Category::find()->where(['user_id' => Yii::$app->user->id]);

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

}