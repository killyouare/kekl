<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $login
 * @property int $role
 * @property string $email
 * @property string $password
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $repeatPassword;
    public $rule;

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        return self::findOne(['login' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'email', 'password'], 'required'],
            [['role'], 'integer'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 255],
            [['repeatPassword'], 'compare', 'compareAttribute' => 'password'],
            [['rule'], 'compare', 'compareValue' => 1],
            [['email', 'login'], 'unique'],
            [['email'], 'email'],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[А-яёЁ ]*$/i'],
            [['password'], 'string', 'length' => [6, 255]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Имя пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
            'repeatPassword' => 'Повторите пароль',
            'rule' => 'Согласие с правилами регистрации',
        ];
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return parent::beforeSave($insert);
    }

    public function isAdmin()
    {
        return $this->role;
    }
}
