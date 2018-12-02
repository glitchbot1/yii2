<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property int $price
 * @property int $category_id
 * @property int $city_id
 * @property bool $isActive
 * @property string $image
 *
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'post';
    }


    public function rules()
    {
      return [
        ['isActive','boolean'],
        ['title','required','message'=>'Заполните заголовок объявления'],
        ['description','required','message'=>'Заполните описание объявления'],
        ['city_id','required','message'=>'Укажите свой город'],
        ['category_id','required','message'=>'Выбрите категорию'],
        ['price','required','message'=>'Укажите цену'],
        ['price','integer','message'=>'Введите только цифры'],
        ['image','image','extensions'=>'jpg,png,jpeg','message'=>'Выберите фотографию формата jpg, jpeg, png'],
        ['image','file', 'maxSize' => 1024*1024*10, 'message'=>'Выберите аватарку до 10 Мб.'],
        [['date'],'date','format'=>'php:Y-m-d H:i:s'],
        ['date','default','value'=>date('Y-m-d H:i:s')],

      ];
    }


    public function attributeLabels()
    {
      return [
        'id' => 'ID',
        'user_ID' => 'User_ID',
        'title' => 'Заголовок',
        'category_id' => 'Категория',
        'description' => 'Описание',
        'city_id' => 'Город',
        'price' => 'Цена',
        'image' => 'Картинка',
        'date' => 'Дата',
        'isActive' => 'Is Active',

      ];
    }
    public function getUser()
    {
      return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCategory(){

      return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }


    public function getCity(){

      return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    public function createPost($post)
    {
      $post->user_id = Yii::$app->user->id;
      $post->title=$this->title;
      $post->category_id = $this->category_id;
      $post->description = $this->description;
      $post->city_id = $this->city_id;
      $post->price = $this->price;

      return $post->save()? true: false;
    }

    public function updateImage()
    {
      if($this->validate() && !empty($this->image))
      {
        return $this->image->saveAs('post/'.$this->image->baseName. '.' . $this->image->extension);

      }
      else{
        return false;
      }
    }
}
