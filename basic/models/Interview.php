<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "interview".
 *
 * @property integer $id
 * @property string $message_title
 * @property string $message_content
 * @property string $datetime_history
 * @property integer $id_operator_history
 * @property integer $id_runner_history
 */
class Interview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interview';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_title', 'message_content', 'datetime_history', 'id_operator_history', 'id_runner_history'], 'required'],
            [['message_title', 'message_content'], 'string'],
            [['datetime_history'], 'safe'],
            [['id_operator_history', 'id_runner_history'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'message_title' => Yii::t('app', 'Message Title'),
            'message_content' => Yii::t('app', 'Message Content'),
            'datetime_history' => Yii::t('app', 'Datetime History'),
            'id_operator_history' => Yii::t('app', 'Id Operator History'),
            'id_runner_history' => Yii::t('app', 'Id Runner History'),
        ];
    }

    /**
     * @inheritdoc
     * @return InterviewQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InterviewQuery(get_called_class());
    }
}
