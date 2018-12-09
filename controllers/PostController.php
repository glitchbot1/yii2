<?php
namespace app\controllers;

use app\models\Notice;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use app\models\Post;
use app\models\City;
use app\models\Category;
use app\models\Profile;
use yii\filters\AccessControl;
use yii\web\UploadedFile;



class PostController extends Controller
{

    public function behaviors()
    {
        return [
          'access' =>[
           'class'=>AccessControl::className(),
           'rules'=>[
              [
                'allow' => true,
                'actions' => ['post','notice','update','delete-image','view','open','close'],
                'roles'=>['@'],
              ],
              [
              'allow' => true,
              'actions' => ['view'],
              'roles'=>['?'],
              ],
          ],
        ],
     ];
    }


    public function actionPost() // Создание объявления
    {
        $post_model=new Post(); // Создаем новый объект

        $category = Category::find()->all();

        $city = City::find()->all();
        //Загружаем его и проверяем валидацией
        if ($post_model->load(Yii::$app->request->post()) && $post_model->validate()) {
          //Метод загрузки изображения
          $image = Yii::$app->cache->get('image');
          if(!$image) {

            $image = UploadedFile::getInstance($post_model, 'image');
            if (!is_null($image)) {

              $post_model->img = $post_model->updateImage($image);
              Yii::$app->cache->set('image',$image,3600);
            }
          }
          //вызываем метод создания объявления и загрузки изображения
            if ($post_model->createPost($post_model)) {
            Yii::$app->session->setFlash('success', 'Объявление успешно добавлено');

          }
          else {

            Yii::$app->session->setFlash('error', 'Ошибка');
          }
        }

        return $this->render('post', [
          'post_model' => $post_model,
          'category'=>$category,
          'city'=>$city]);
    }

    public function actionNotice() //Страница объявлений ползователя
    {
          $categories = Category::find()->all();

          if (isset($_GET['category'])) {
            $category = Category::find()->where(['title'=>$_GET['category']])->all();
            $cat_id = ArrayHelper::getColumn($category,'id');
            $my_posts = Post::find()->where(['category_id'=>$cat_id]);
          }

          if (isset($_GET['status']) && $_GET['status'] == 'active') {
            $my_posts = Post::find()->where(['user_id'=>Yii::$app->user->id,'isActive' => true] );
          }

          if (isset($_GET['status']) && $_GET['status'] == 'close') {
            $my_posts = Post::find()->where(['user_id'=>Yii::$app->user->id,'isActive' => false] );
          }

          if (!isset($_GET['status'])) {
            $my_posts = Post::find()->where(['user_id'=>Yii::$app->user->id] );
          }

          $pages = new Pagination(['totalCount' => $my_posts->count()]);
          $notice_model = $my_posts->offset($pages->offset)->limit($pages->limit)->orderBy('date DESC')->all();

        return $this->render('notice',[
          'notice_model'=>$notice_model,
          'pages'=>$pages,
          'categories'=>$categories,
        ]);
    }

    public function actionUpdate($id) //Редактирование объявления
    {

      $update_model = Post::find()->where(['id'=>$id])->one();

        if ($update_model->load(Yii::$app->request->post()) && $update_model->validate()) {
          $image = UploadedFile::getInstance($update_model, 'image');
          if(!is_null($image)) {
            $update_model->img = $update_model->updateImage($image);

          }
          $update_model->save();

            return $this->redirect(['post/notice']);
        }

        return $this->render('update',[
          'update_model'=>$update_model,
        ]);
    }

    public function actionDeleteImage($id) // Удаление картинки
    {
     $delete = Post::findOne($id);
     $file_name = $delete->img;
     //var_dump($file_name);
       if(file_exists($file_path = Yii::getAlias('@web').'post/'. $file_name))
       {
         unlink(Yii::getAlias('@web').'post/'.$file_name);
       }
       if($delete)
       {
         $delete->img = null;
         $delete->update();
       }

     Yii::$app->session->setFlash('success','Фотография удалена');
     return $this->redirect(['notice']);

    }

    public function actionView($id) // Просмотреть объявление
    {
        // Заносим данные текущего обявления в переменную $notice_model
        $notice_model = Post::find()->where(['id' => $id])->all();
        // в $user_id записывает значения столбца user_id
        $user_id = ArrayHelper::getColumn($notice_model, 'user_id');
        // записываем в переменну  $count_notice количество запсией пользователя
        $count_notice = Post::find()->where(['user_id'=>$user_id])->count();
        //заносим данные текущего пользователя в переменную $user_model
        $user_model = Profile::find()->where(['user_id' => $user_id])->one();

        return $this->render('view',
          [
            'notice_model'=>$notice_model,
            'user_model'=>$user_model,
            'count'=>$count_notice,
          ]);
    }

      public function actionClose($id) // Закрытие объявления
      {
        $post = Post::findOne($id);
        $post->isActive = false;
        $post->update();
        Yii::$app->session->setFlash('success', 'Ваше объявление успешно закрыто');
        return $this->redirect(['notice']);
      }
      public function actionOpen($id) // Открытие объявления
      {
        $post = Post::findOne($id);
        $post->isActive = true;
        $post->update();
        Yii::$app->session->setFlash('success', 'Ваше объявление успешно открыто');
        return $this->redirect(['notice']);
      }
}
