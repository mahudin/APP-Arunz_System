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

class UsersSearch extends Model
{
    public $id;
    public $email;
    public $uname;
    public $surname;
    public $sex;
    public $phone;
    public $zip_code;
    public $state;
    public $city;
    public $street;
    public $code_country;
    public $shirt_size;
    public $join_date;
    public $walking_for;
    public $walking_because;
    public $walking_count;
    public $from_medium;
    public $assignment;

    public function rules()
    {
        return [
            [['id','sex' ], 'integer'],
            [['email', 'uname','surname','phone','state','city','street','zip_code','shirt_size','join_date','from_medium','assignment' ], 'string'],
            [['email', 'uname','surname','phone','state','city','street','zip_code','shirt_size','join_date','from_medium','assignment' ], 'safe'],

        ];
    }

    public function search($params)
    {
        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'uname', $this->uname])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'shirt_size', $this->shirt_size])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'from_medium', $this->from_medium])
            ->andFilterWhere(['like', 'sex', $this->sex]);

        if ( ! is_null($this->join_date) && strpos($this->join_date, ' - ') !== false ) 
		{
            list($start_date, $end_date) = explode(' - ', $this->join_date);
            $query->andFilterWhere(['between', 'join_date', $start_date." 00:00:00", $end_date." 23:59:59"]);
        }

        return $dataProvider;
    }

}