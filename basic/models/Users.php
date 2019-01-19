<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $uname
 * @property string $surname
 * @property integer $sex
 * @property string $phone
 * @property string $zip_code
 * @property string $state
 * @property string $city
 * @property string $street
 * @property string $code_country
 * @property string $walking_for
 * @property string $walking_count
 * @property string $walking_because
 * @property string $shirt_size
 * @property string $nr_card
 * @property string $date_card
 * @property string $uname_card
 * @property string $surname_card
 * @property string $cvv_cvc
 * @property string $join_date
 * @property string $from_medium
 * @property string $ip_adress
 * @property integer $is_online
 * @property string $remember_token
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex'], 'required'],
            [['sex', 'is_online'], 'integer'],
            [['date_card', 'join_date'], 'safe'],
            [['email', 'password', 'uname', 'surname', 'city', 'street', 'walking_for', 'walking_count', 'walking_because', 'shirt_size', 'nr_card', 'uname_card', 'surname_card', 'remember_token','assignment','assignment2','assignment3'], 'string', 'max' => 255],
            [['phone', 'cvv_cvc'], 'string', 'max' => 12],
            [['zip_code', 'state', 'code_country', 'ip_adress'], 'string', 'max' => 64],
            [['from_medium'], 'string', 'max' => 24],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'uname' => Yii::t('app', 'Uname'),
            'surname' => Yii::t('app', 'Surname'),
            'sex' => Yii::t('app', 'Sex'),
            'phone' => Yii::t('app', 'Phone'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'state' => Yii::t('app', 'State'),
            'city' => Yii::t('app', 'City'),
            'street' => Yii::t('app', 'Street'),
            'code_country' => Yii::t('app', 'Code Country'),
            'walking_for' => Yii::t('app', 'Walking For'),
            'walking_count' => Yii::t('app', 'Walking Count'),
            'walking_because' => Yii::t('app', 'Walking Because'),
            'shirt_size' => Yii::t('app', 'Shirt Size'),
            'nr_card' => Yii::t('app', 'Nr Card'),
            'date_card' => Yii::t('app', 'Date Card'),
            'uname_card' => Yii::t('app', 'Uname Card'),
            'surname_card' => Yii::t('app', 'Surname Card'),
            'cvv_cvc' => Yii::t('app', 'Cvv Cvc'),
            'join_date' => Yii::t('app', 'Join Date'),
            'from_medium' => Yii::t('app', 'From Medium'),
            'assignment'=> Yii::t('app', 'Assignment'),
            'assignment2'=> Yii::t('app', 'Assignment 2'),
            'assignment3'=> Yii::t('app', 'Assignment 3'),
            'ip_adress' => Yii::t('app', 'Ip Adress'),
            'is_online' => Yii::t('app', 'Is Online'),
            'remember_token' => Yii::t('app', 'Remember Token'),
        ];
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
}
