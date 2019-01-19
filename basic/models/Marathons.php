<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marathons".
 *
 * @property integer $id
 * @property string $title
 * @property double $distance
 * @property string $place
 * @property string $date_term
 * @property string $time_term
 * @property string $start_register
 * @property string $end_register
 * @property string $road_type
 * @property double $limit_time_on_road
 * @property string $buy
 * @property string $link
 * @property string $link_road
 * @property integer $available
 * @property string $attention
 */
class Marathons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marathons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['distance', 'limit_time_on_road'], 'number'],
            [['date_term', 'time_term', 'start_register', 'end_register'], 'safe'],
            [['available'], 'integer'],
            [['attention'], 'string'],
            [['title', 'place', 'road_type', 'buy', 'link','link_road'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'distance' => Yii::t('app', 'Distance'),
            'place' => Yii::t('app', 'Place'),
            'date_term' => Yii::t('app', 'Date Term'),
            'time_term' => Yii::t('app', 'Time Term'),
            'start_register' => Yii::t('app', 'Start Register'),
            'end_register' => Yii::t('app', 'End Register'),
            'road_type' => Yii::t('app', 'Road Type'),
            'limit_time_on_road' => Yii::t('app', 'Limit Time On Road'),
            'buy' => Yii::t('app', 'Buy'),
            'link' => Yii::t('app', 'Link'),
            'link_road'=> Yii::t('app', 'Link Road'),
            'available' => Yii::t('app', 'Available'),
            'attention' => Yii::t('app', 'Attention'),
        ];
    }

    /**
     * @inheritdoc
     * @return MarathonsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MarathonsQuery(get_called_class());
    }
}
