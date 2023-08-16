<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cart}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $book_isbn
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Book $bookIsbn
 * @property User $user
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cart}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'book_isbn'], 'required'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['book_isbn'], 'string', 'max' => 20],
            [['book_isbn'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_isbn' => 'book_isbn']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'book_isbn' => 'Book Isbn',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CartQuery(get_called_class());
    }
}
