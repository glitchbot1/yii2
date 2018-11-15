<?php
namespace  app\models;

use yii\base\Model;

class Signup extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [

            ['email','required','message'=>'Пожалуйсто заполните email'],
            ['password','required','message'=>'Пожалуйсто заполните Пароль'],
            [['email'],'email', 'message'=>'Неправильный email'],
            [['email'],'unique', 'targetClass'=>User::ClassName(),'message'=>'Этот email занят'],
            [['password'],'string','min'=>6,'max'=>30 ,'message'=>'Пожалуйсто заполните password'],

        ];
    }

    public function signup() //регистрация
    {
        $user = new User();// создание нового объекта модели User
        $user->email = $this->email;//поле email равно введеному имелу в форме
        $user->password = sha1($this->password);//поле password равно введеному имелу в форме
        return $user->save();//сохранить
    }

    public function attributeLabels()
    {
        return
        [
          'email'=> 'E-Mail:',
          'password'=> 'Пароль:',
        ];
    }

}