<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\OrderedBook]].
 *
 * @see \common\models\OrderedBook
 */
class OrderedBookQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\OrderedBook[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\OrderedBook|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
