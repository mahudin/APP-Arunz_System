<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21.02.2017
 * Time: 23:09
 */

namespace app\models;
use yii\data\ActiveDataProvider;
use yii\base\Model;

class ReminderSearch extends Model
{
    public $id;
    public $idu;
    public $note;
    public $datetime_reminder;
    public $id_operator;

    public function rules()
    {
        return [
            [['id','idu','id_operator' ], 'integer'],
            [['note', 'datetime_reminder' ], 'string'],
            [['note', 'datetime_reminder' ], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Reminder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'datetime_reminder', $this->datetime_reminder]);

        return $dataProvider;
    }

}