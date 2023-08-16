<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%book}}`
 */
class m230815_103344_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'book_isbn' => $this->string(20)->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-cart-user_id}}',
            '{{%cart}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-cart-user_id}}',
            '{{%cart}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `book_isbn`
        $this->createIndex(
            '{{%idx-cart-book_isbn}}',
            '{{%cart}}',
            'book_isbn'
        );

        // add foreign key for table `{{%book}}`
        $this->addForeignKey(
            '{{%fk-cart-book_isbn}}',
            '{{%cart}}',
            'book_isbn',
            '{{%book}}',
            'book_isbn',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-cart-user_id}}',
            '{{%cart}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-cart-user_id}}',
            '{{%cart}}'
        );

        // drops foreign key for table `{{%book}}`
        $this->dropForeignKey(
            '{{%fk-cart-book_isbn}}',
            '{{%cart}}'
        );

        // drops index for column `book_isbn`
        $this->dropIndex(
            '{{%idx-cart-book_isbn}}',
            '{{%cart}}'
        );

        $this->dropTable('{{%cart}}');
    }
}
