<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string|null $zipcode
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'city', 'state', 'country','zipcode',], 'required'],
            [['name'], 'string', 'max' => 100],
            [['address', 'city', 'state', 'country', 'zipcode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'zipcode' => 'Zipcode',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ClientsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ClientsQuery(get_called_class());
    }
}
