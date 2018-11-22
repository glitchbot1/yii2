<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property int $isAdmin
 *
 * @property Post[] $posts
 * @property Profile @profile
 */

class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isAdmin'], 'default', 'value' => null],
            [['isAdmin'], 'integer'],
            [['email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'isAdmin' => 'Is Admin',
        ];
    }
    public function getPosts()
    {
      return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }


    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }


    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }
    public static function findIdentity($id)
    {
        return self::findOne($id); //запрос в базу
    }
    public function getId()
    {
        return $this->id;
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }
    public function getAuthKey()
    {
    }
    public function validateAuthKey($authKey)
    {
    }

}
