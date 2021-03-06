<?php

namespace app\models;
use Faker\Provider\Image;
use yii\web\UploadedFile;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use yii\db\Exception;
use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $user_id
 * @property string $name
 * @property int $city_id
 * @property int $phone
 * @property string $description
 * @property string $dateRegistration
 * @property string $photo
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{

   public $photo;



    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'],'required','message'=>'Заполните имя'],
            [['phone'],'required','message'=>'Укажите свой мобильный телефон'],
            [['city_id'],'required','message'=>'Укажите свой город'],
            ['description','string'],
            [['phone'], 'string', 'length' => [10]],
            ['phone','number','message'=>'В номере должны быть только цифры'],
            ['photo','file','extensions' => 'png, jpg'],
            ['photo','file', 'maxSize' => 1024*1024*3,],
            ['img','string'],
            [['dateRegistration'],'date','format'=>'php:Y-m-d H:i:s'],
            ['dateRegistration','default','value'=>date('Y-m-d H:i:s')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'user_id',
            'name' => 'Имя',
            'city_id' => 'Город',
            'phone' => ' 7+',
            'description' => 'О себе',
            'dateRegistration' => '',
            'photo' => '',

        ];
    }
    public function getUser()
    {
      return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function updateProfile($profile) // Обновления профиля ползователя
    {
      $profile->user_id = Yii::$app->user->id;
      $profile->name = $this->name;
      $profile->phone = $this->phone;
      $profile->city_id = $this->city_id;
      $profile->description = $this->description;

        return $profile->save();

    }

    public function uploadImage($photo)  //Загрузка картинки
    {
      if ($this->validate()) {

        $filename = strtolower(uniqid($photo->baseName)) . '.' . $photo->extension;

        $path = Yii::getAlias($this->getFolder() . $filename);
        if($photo->saveAs($path))
        {
           return $filename;
        }
      }
      else {
        return false;
      }
    }



    public function getFolder()
    {
      return Yii::getAlias('@web').'uploads/image_profile/' ;
    }


}
