<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Salaries;

/**
 * SalariesSearch represents the model behind the search form of `app\models\Salaries`.
 */
class SalariesSearch extends Salaries
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'drivers_orders_id'], 'integer'],
            [['salary'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Salaries::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'drivers_orders_id' => $this->drivers_orders_id,
            'salary' => $this->salary,
        ]);

        return $dataProvider;
    }
}
