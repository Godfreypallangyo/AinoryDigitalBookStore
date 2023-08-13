<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderedBook;

/**
 * OrderedBookSearch represents the model behind the search form of `common\models\OrderedBook`.
 */
class OrderedBookSearch extends OrderedBook
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order_id'], 'integer'],
            [['book_title', 'book_isbn'], 'safe'],
            [['book_price'], 'number'],
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
        $query = OrderedBook::find();

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
            'book_price' => $this->book_price,
            'order_id' => $this->order_id,
        ]);

        $query->andFilterWhere(['like', 'book_title', $this->book_title])
            ->andFilterWhere(['like', 'book_isbn', $this->book_isbn]);

        return $dataProvider;
    }
}
