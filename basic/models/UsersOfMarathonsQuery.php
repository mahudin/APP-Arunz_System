<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsersOfMarathons]].
 *
 * @see UsersOfMarathons
 */
class UsersOfMarathonsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UsersOfMarathons[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UsersOfMarathons|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
