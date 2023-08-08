<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ordered_book".
 *
 * @property int $id
 * @property string $book_title
 * @property string $book_isbn
 * @property float|null $book_price
 * @property int $order_id
 *
 * @property Book $bookIsbn
 */
class OrderedBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordered_book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_title', 'book_isbn', 'order_id'], 'required'],
            [['book_price'], 'number'],
            [['order_id'], 'integer'],
            [['book_title'], 'string', 'max' => 255],
            [['book_isbn'], 'string', 'max' => 20],
            [['book_isbn'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_isbn' => 'book_isbn']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_title' => 'Book Title',
            'book_isbn' => 'Book Isbn',
            'book_price' => 'Book Price',
            'order_id' => 'Order ID',
        ];
    }

    /**
     * Gets query for [[BookIsbn]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\BookQuery
     */
    public function getBookIsbn()
    {
        return $this->hasOne(Book::className(), ['book_isbn' => 'book_isbn']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\OrderedBookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderedBookQuery(get_called_class());
    }
}
