<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ListPayments]].
 *
 * @see ListPayments
 */
class ListPaymentsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ListPayments[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ListPayments|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
