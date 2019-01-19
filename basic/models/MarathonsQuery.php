<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Marathons]].
 *
 * @see Marathons
 */
class MarathonsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Marathons[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Marathons|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
