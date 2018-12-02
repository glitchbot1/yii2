<?php
namespace  app\models;

use yii\base\Model;
use yii\web\ErrorAction;

class Login extends Model
{

    public $email;
    public $password;

    public function rules()
    {
        return
        [
          [['email'],'email','message'=>'Это не email,исправьте'],
          [['password'],'validatePassword'],
          ['email','required','message'=>'Пожалуйста заполните email'],
          ['password','required','message'=>'Пожалуйста заполните Пароль'],


        ];
    }

    public function validatePassword($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $user = $this->getUser();

            if(!$user || !$user->validatePassword($this->password))
            {
                return $this->addError($attribute,'Неверный email или пароль');
            }

        }

    }

    public function getUser()
    {
            return User::findOne(['email'=>$this->email]);
    }


    public function attributeLabels()
    {
        return
            [
                'email'=> 'Ваш E-Mail:',
                'password'=> 'Ваш Пароль:',
            ];
    }


}