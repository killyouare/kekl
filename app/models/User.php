<?php

namespace app\models;

use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $fio
 * @property string $username
 * @property int $role
 * @property int $password
 * @property int $email
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $repeatPassword;

    public $checkMark;

    public static function findIdentity(
        $id
    ): User|IdentityInterface|null {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): User|IdentityInterface|null
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername(string $username): ?User
    {
        return static::findOne(['username' => $username]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->authKey === $authKey;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'username', 'password', 'email', 'repeatPassword', 'checkMark'], 'required'],
            [['role'], 'integer'],
            [['fio', 'username', 'password', 'email', 'repeatPassword'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['repeatPassword'], 'compare', 'compareAttribute' => 'password'],
            [['checkMark'], 'compare', 'compareValue' => 1],
            ['fio', 'match', 'pattern' => '/^[А-Я]+[а-я]* [А-Я]+[а-я]* [А-Я]+[а-я]*$/m']

        ];
    }

    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Фио',
            'username' => 'Имя пользователя',
            'role' => 'Role',
            'password' => 'Пароль',
            'repeatPassword' => 'Повторите пароль',
            'checkMark' => 'Согласие об обработке персональных данных',
            'email' => 'Email',
        ];
    }

    public function validatePassword($password)
    {
        return $this->password = md5($password);
    }
}
