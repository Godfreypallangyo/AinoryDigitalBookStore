<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m230814_112004_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'order_number' => $this->string()->notNull()->unique(),
            'order_total' => $this->decimal(10, 2)->notNull(),
            'payment_status' => $this->string()->notNull(),
            'payment_method' => $this->string(),
            'billing_address' => $this->text(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey(
            'fk-orders-client_id',
            '{{%orders}}',
            'client_id',
            '{{%clients}}', // Assuming your client table is named 'clients'
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
