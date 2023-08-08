<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Book;

/**
 * BookSearch represents the model behind the search form of `common\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_isbn', 'book_title', 'book_author', 'book_image', 'book_file', 'book_descr'], 'safe'],
            [['book_price'], 'number'],
            [['book_publisher_id'], 'integer'],
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
        $query = Book::find();

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
            'book_price' => $this->book_price,
            'book_publisher_id' => $this->book_publisher_id,
        ]);

        $query->andFilterWhere(['like', 'book_isbn', $this->book_isbn])
            ->andFilterWhere(['like', 'book_title', $this->book_title])
            ->andFilterWhere(['like', 'book_author', $this->book_author])
            ->andFilterWhere(['like', 'book_image', $this->book_image])
            ->andFilterWhere(['like', 'book_file', $this->book_file])
            ->andFilterWhere(['like', 'book_descr', $this->book_descr]);

        return $dataProvider;
    }
}
