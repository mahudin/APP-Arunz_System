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

class InterviewSearch extends Model
{
    public $id;
    public $message_title;
    public $message_content;
    public $datetime_history;
    public $id_operator_history;
    public $id_runner_history;


    public function rules()
    {
        return [
            [['message_title', 'message_content', 'datetime_history', 'id_operator_history', 'id_runner_history'], 'required'],
            [['message_title', 'message_content'], 'string'],
            [['datetime_history'], 'safe'],
            [['id_operator_history', 'id_runner_history'], 'integer'],
        ];
    }

    public function search($params)
    {
        $query = Interview::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'message_title', $this->message_title])
            ->andFilterWhere(['like', 'message_content', $this->message_content]);



        return $dataProvider;
    }

}