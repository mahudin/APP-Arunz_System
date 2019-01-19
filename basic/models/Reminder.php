<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reminder".
 *
 * @property integer $id
 * @property integer $idu
 * @property string $note
 * @property string $datetime_reminder
 */
class Reminder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reminder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idu','id_operator'], 'integer'],
            [['datetime_reminder'], 'safe'],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_operator'=>Yii::t('app',"ID operator"),
            'idu' => Yii::t('app', 'Idu'),
            'note' => Yii::t('app', 'Note'),
            'datetime_reminder' => Yii::t('app', 'Datetime Reminder'),
        ];
    }

    /**
     * @inheritdoc
     * @return ReminderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReminderQuery(get_called_class());
    }
}
