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

    public $image;

    public static function tableName()
    {
        return 'post';
    }


    public function rules()
    {
      return [
        ['isActive','boolean'],
        [['title'],'required','message'=>'Заполните заголовок объявления'],
        [['description'],'required','message'=>'Заполните описание объявления'],
        [['city_id'],'required','message'=>'Укажите свой город'],
        [['category_id'],'required','message'=>'Выбрите категорию'],
        [['price'],'required','message'=>'Укажите цену'],
        ['price','integer','message'=>'Введите только целые цифры'],
        ['image','file', 'extensions'=>'jpg,png,jpeg'],
        ['image','file', 'maxSize'=>1024*1024*10],
        ['img','string',],
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
        'image' => '',
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

      return $post->save();
    }

    public function updateImage($image)
    {
      if($this->validate())
      {
        $filename = strtolower(uniqid($image->baseName)) . '.' . $image->extension;
          $path = Yii::getAlias( $this->getFolder(). $filename );
          if($image->saveAs($path)) {
            return $filename;
          }
        }
      else{
        return false;
      }
    }

    public function getFolder()
    {
      return Yii::getAlias('@web').'uploads/post_image/' ;
    }
}
