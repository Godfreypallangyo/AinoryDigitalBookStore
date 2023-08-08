<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ordered_book}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%book}}`
 * - `{{%orders}}`
 */
class m230806_123319_create_ordered_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ordered_book}}', [
            'id' => $this->primaryKey(),
            'book_title' => $this->string(255)->notNull(),
            'book_isbn' => $this->string(20)->notnull(),
            'book_price' => $this->decimal(6,2),
            'order_id' => $this->integer(11)->notNull(),
        ]);

        // creates index for column `book_isbn`
        $this->createIndex(
            '{{%idx-ordered_book-book_isbn}}',
            '{{%ordered_book}}',
            'book_isbn'
        );

        // add foreign key for table `{{%book}}`
        $this->addForeignKey(
            '{{%fk-ordered_book-book_isbn}}',
            '{{%ordered_book}}',
            'book_isbn',
            '{{%book}}',
            'book_isbn',
            'CASCADE'
        );

        // creates index for column `order_id`
        $this->createIndex(
            '{{%idx-ordered_book-order_id}}',
            '{{%ordered_book}}',
            'order_id'
        );

        // add foreign key for table `{{%orders}}`
        $this->addForeignKey(
            '{{%fk-ordered_book-order_id}}',
            '{{%ordered_book}}',
            'order_id',
            '{{%orders}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%book}}`
        $this->dropForeignKey(
            '{{%fk-ordered_book-book_isbn}}',
            '{{%ordered_book}}'
        );

        // drops index for column `book_isbn`
        $this->dropIndex(
            '{{%idx-ordered_book-book_isbn}}',
            '{{%ordered_book}}'
        );

        // drops foreign key for table `{{%orders}}`
        $this->dropForeignKey(
            '{{%fk-ordered_book-order_id}}',
            '{{%ordered_book}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-ordered_book-order_id}}',
            '{{%ordered_book}}'
        );

        $this->dropTable('{{%ordered_book}}');
    }
}
