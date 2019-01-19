<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "users_of_marathons".
 *
 * @property integer $idm
 * @property integer $idu
 * @property integer $status
 */
class UsersOfMarathonsSearch extends Model
{
    public $id;
    public $idm;
    public $idu;
    public $status;
    public $title;
    public $passing;

    public function search($params)
    {
        $query = UsersOfMarathons::find()
            ->select(['id','idm','title','status','place','passing'])
            ->leftJoin('marathons','users_of_marathons.idm=marathons.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}
