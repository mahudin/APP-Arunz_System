<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "list_payments".
 *
 * @property integer $id
 * @property integer $idu
 * @property integer $payment_id
 * @property string $payment_status
 * @property string $payment_cash
 * @property string $datetime_payment
 */
class ListPayments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list_payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idu','idm','payment_id'], 'integer'],
            [['datetime_payment'], 'safe'],
            [['payment_status', 'payment_cash'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'idu' => Yii::t('app', 'Idu'),
            'idm' => Yii::t('app', 'Idm'),
            'payment_id' => Yii::t('app', 'ID transakcji'),
            'payment_status' => Yii::t('app', 'Status transakcji'),
            'payment_cash' => Yii::t('app', 'Kwota'),
            'datetime_payment' => Yii::t('app', 'Czas transakcji'),
        ];
    }

    /**
     * @inheritdoc
     * @return ListPaymentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ListPaymentsQuery(get_called_class());
    }
}
