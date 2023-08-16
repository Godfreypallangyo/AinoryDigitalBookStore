<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property int $id
 * @property int $client_id
 * @property string $order_number
 * @property float $order_total
 * @property int $payment_status
 * @property string|null $payment_method
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Clients $client
 * @property OrderedBook[] $orderedBooks
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'order_number', 'order_total', 'payment_status'], 'required'],
            [['client_id', 'payment_status'], 'integer'],
            [['order_total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['order_number', 'payment_method'], 'string', 'max' => 255],
            [['order_number'], 'unique'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'order_number' => 'Order Number',
            'order_total' => 'Order Total',
            'payment_status' => 'Payment Status',
            'payment_method' => 'Payment Method',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ClientsQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    /**
     * Gets query for [[OrderedBooks]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderedBookQuery
     */
    public function getOrderedBooks()
    {
        return $this->hasMany(OrderedBook::className(), ['order_id' => 'id']);
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
