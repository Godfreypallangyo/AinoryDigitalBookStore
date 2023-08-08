<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m230805_082333_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'book_isbn' => $this->string(20)->notNull(),
            'book_title' => $this->string()->notNull(),
            'book_author' => $this->string()->notNull(),
            'book_image' => $this->string(),
            'book_file' => $this->string(),
            'book_descr' => $this->text(),
            'book_price' => $this->decimal(10, 2)->notNull(),
            'book_publisher_id' => $this->integer(),
        ]);

        $this->addPrimaryKey('PK_book','{{%book}}','book_isbn');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
