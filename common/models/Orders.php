<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $order_id
 * @property float $total_price
 * @property int $status
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $transaction_id
 * @property int|null $created_at
 * @property int|null $created_by
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_price', 'status', 'firstName', 'lastName', 'email', 'transaction_id'], 'required'],
            [['total_price'], 'number'],
            [['status', 'created_at', 'created_by'], 'integer'],
            [['firstName', 'lastName'], 'string', 'max' => 45],
            [['email', 'transaction_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'total_price' => 'Total Price',
            'status' => 'Status',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'transaction_id' => 'Transaction ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrdersQuery(get_called_class());
    }
}
