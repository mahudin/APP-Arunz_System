<?php

namespace app\models;

use Yii;
use DateTime;
/**
 * This is the model class for table "users_of_marathons".
 *
 * @property integer $idm
 * @property integer $idu
 * @property integer $status
 */
class UsersOfMarathons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_of_marathons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','idm', 'idu', 'status'], 'integer'],
            [[ 'passing'], 'datetime'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'    => Yii::t('app',"Id"),
            'idm' => Yii::t('app', 'Idm'),
            'idu' => Yii::t('app', 'Idu'),
            'status' => Yii::t('app', 'Status'),
            'passing' => Yii::t('app', 'Wyprzedzenie'),
        ];
    }

    /**
     * @inheritdoc
     * @return UsersOfMarathonsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersOfMarathonsQuery(get_called_class());
    }

    public static function count_course($idm){
        $trasa=Marathons::findOne(["id"=>$idm]);
        $start=$trasa->date_term." ".$trasa->time_term;
        $date1 = new DateTime("now");
        $date2 = new DateTime($start);
        $interval = $date1->diff($date2);
        return $interval->y . " rok, " . $interval->m." miesięcy, ".$interval->d." dni ".$interval->h." godzin ".$interval->i." minut ".$interval->s." sekund";
    }

    public static function count_and_save_course($idm,$id){
        $trasa=Marathons::findOne(["id"=>$idm]);
        $start=$trasa->date_term." ".$trasa->time_term;
        $date1 = new DateTime("now");
        $date2 = new DateTime($start);
        $interval = $date1->diff($date2);
        $przedbieg=$interval->y . " rok, " . $interval->m." miesięcy, ".$interval->d." dni ".$interval->h." godzin ".$interval->i." minut ".$interval->s." sekund";
        UsersOfMarathons::updateAll(['passing'=>$przedbieg],["id"=>$id]);//["id"=>$id],"passing=:passing"
        return $przedbieg;
    }
}
