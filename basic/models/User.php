<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use \yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $id;
    public $username;
    public $name;
    public $surname;
    public $password;
    public $authKey;
    public $accessToken;

    public static function tableName()
    {
        return 'operator';
    }

    public static function getUsers(){
        return Yii::$app->db->createCommand('SELECT * FROM operator')->queryAll();
    }

    public function rules(){

        return [
            [['username', 'password'], 'required'],
            [['username', 'password','accessToken','authKey'], 'string', 'max' => 100]
        ];
    }

    /**
    039
     * @inheritdoc
    040
     */

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'username' => 'Username',
            'password' => 'Password',

        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {

        foreach(self::getUsers() as $user){
            if($user['id']==$id){
                return new static($user);
            }
        }

        return  null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::getUsers() as $user) {
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

        foreach (self::getUsers() as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
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
