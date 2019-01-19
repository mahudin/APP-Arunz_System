<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18.02.2017
 * Time: 14:14
 */

namespace app\models;

use Yii;
use yii\base\Model;

class Operator extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public function rules()
    {
        return [
            [['username','name','surname'], 'string'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'password' => Yii::t('app', 'Password'),
        ];
    }

    public static function tableName()
    {
        return 'operator';
    }

    public static function find()
    {
        return Yii::$app->db->createCommand('SELECT * FROM '.self::tableName())->queryAll();
    }
    /**
     * @inheritdoc
     */
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return isset(self::find()[$id]) ? new static(self::find()[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::find() as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {

        foreach (self::find() as $user) {
            if (strcasecmp($user['login'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

}