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

class MarathonsSearch extends Model
{
    public $id;
    public $title;
    public $distance;
    public $place;
    public $date_term;
    public $time_term;
    public $start_register;
    public $end_register;
    public $buy;
    public $link;
    public $link_road;
    public $attention;
    public $available;
    public $road_type;
    public $limit_time_on_road;

    public function rules()
    {
        return [
            [['id','distance' ], 'integer'],
            [['place', 'title','date_term','time_term','start_register','end_register','road_type','link','limit_time_on_road','available','buy','attention','link_road' ], 'string'],
            [['place', 'title','date_term','time_term','start_register','end_register','road_type','link','limit_time_on_road','available','buy','attention','link_road' ], 'safe'],

        ];
    }

    public function search($params)
    {
        $query = Marathons::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);



        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'link_road', $this->link_road])
            ->andFilterWhere(['like', 'buy', $this->buy])
            ->andFilterWhere(['like', 'attention', $this->attention])
            ->andFilterWhere(['like', 'available', $this->available])
            ->andFilterWhere(['like','limit_time_on_road',$this->limit_time_on_road])
            ->andFilterWhere(['like', 'distance', $this->distance])
            ->andFilterWhere(['like', 'road_type', $this->road_type]);

       /* if ( ! is_null($this->date_term) && strpos($this->date_term, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->date_term);
            $query->andFilterWhere(['between', 'date_term', $start_date, $end_date]);
        }

        if ( ! is_null($this->start_register) && strpos($this->start_register, ' - ') !== false ) {
            list($start_date2, $end_date2) = explode(' - ', $this->start_register);
            $query->andFilterWhere(['between', 'start_register', $start_date2, $end_date2]);
        }

        if ( ! is_null($this->end_register) && strpos($this->end_register, ' - ') !== false ) {
            list($start_date3, $end_date3) = explode(' - ', $this->end_register);
            $query->andFilterWhere(['between', 'end_register', $start_date3, $end_date3]);
        }*/

        return $dataProvider;
    }

}