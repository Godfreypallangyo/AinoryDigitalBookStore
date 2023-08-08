<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "book".
 *
 * @property string $book_isbn
 * @property string $book_title
 * @property string $book_author
 * @property string|null $book_image
 * @property string|null $book_file
 * @property string|null $book_descr
 * @property float $book_price
 * @property int|null $book_publisher_id
 *
 * @property OrderedBook[] $orderedBooks
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $bookImage;
    /**
     *@var UploadedFile
     */
    public $bookFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_isbn', 'book_title', 'book_author', 'book_price', 'book_file', 'book_image'], 'required'],
            [['book_descr'], 'string'],
            [['book_price'], 'number'],
            [['book_publisher_id'], 'integer'],
            [['book_isbn'], 'string', 'max' => 20],
            [['bookImage'], 'image', 'extensions' => 'png,jpg,jpeg,webp', 'maxSize' => 10 * 1024 * 1024],
            [['book_file'], 'file', 'extensions' => 'pdf', 'maxSize' => 10 * 1024 * 1024],
            [['book_title', 'book_author',], 'string', 'max' => 255],
            [['book_isbn'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_isbn' => 'Book Isbn',
            'book_title' => 'Book Title',
            'book_author' => 'Book Author',
            'book_image' => 'Book Image',
            'book_file' => 'Book File',
            'book_descr' => 'Book Description',
            'book_price' => 'Book Price',
            'book_publisher_id' => 'Book Publisher ID',
        ];
    }

    /**
     * Gets query for [[OrderedBooks]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderedBookQuery
     */
    public function getOrderedBooks()
    {
        return $this->hasMany(OrderedBook::className(), ['book_isbn' => 'book_isbn']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BookQuery(get_called_class());
    }
    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->bookImage && $this->bookFile) {
            $this->book_image = '/book/' . $this->bookImage->name;
            $this->book_file = '/book/' . $this->bookFile->name;
        }
    
        // $transaction = Yii::$app->db->beginTransaction();
    
        try {
            $ok = parent::save($runValidation, $attributeNames);
    
            if ($ok && $this->bookImage && $this->bookFile) {
                $imageFullpath = Yii::getAlias('@frontend/web/storage') . $this->book_image;
                $bookFilefullpath = Yii::getAlias('@frontend/web/storage') . $this->book_file;
                $imageFolder = dirname($imageFullpath);
                $bookFileFolder = dirname($bookFilefullpath);
    
                FileHelper::createDirectory($imageFolder);
                FileHelper::createDirectory($bookFileFolder);
    
                $this->bookImage->saveAs($imageFullpath);
                $this->bookFile->saveAs($bookFilefullpath);
    
            } else {
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    
        return $ok;
    }
    
    public function getImageUrl(){
        return Yii::$app->params['frontendUrl'].'/storage/'.$this->book_image;
    }
}

