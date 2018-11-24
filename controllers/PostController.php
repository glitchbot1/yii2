<?php
namespace app\controllers;

use app\models\User;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use app\models\Post;
use app\models\City;
use app\models\Category;
use app\models\Profile;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

class PostController extends Controller
{

    public function behaviors()
    {
        return [
          'access' =>[
           'class'=>AccessControl::className(),
            'only' => ['logout'],
          'rules'=>[

              [
              'allow' => true,
               'actions' => ['post'],
              'roles'=>['@'],
              ],
              [
              'allow' => true,
              'actions' => ['notice'],
              'roles'=>['@'],
              ],
              [
              'allow' => true,
              'actions' => ['view'],
              'roles'=>['@'],
              ],
          ],
        ],
     ];
    }

    public function actionPost() //создание объявления
    {
        $post_model=new Post(); //создаем новый объект

        if ($post_model->load(Yii::$app->request->post()) && $post_model->validate()): //загружаем его и проверяем валидацией

          $post_model->image = UploadedFile::getInstance($post_model, 'image'); //метод загрузки изображения

          if ($post_model->createPost($post_model) && $post_model->updateImage()): //вызываем метод создания объявления и загрузки изображения

                Yii::$app->session->setFlash('success', 'Объявление успешно добавлено');
           // return $this->redirect(['site/index']);
          else:

                Yii::$app->session->setFlash('error', 'Ошибка');
          endif;
        endif;

        return $this->render('post', ['post_model' => $post_model]);
    }

    public function actionNotice() //страница объявлений ползователя
    {

        $notice_model = Post::find()->where(['user_id'=>Yii::$app->user->id])->all(); //объявления текущего пользователя


        return $this->render('notice',['notice_model'=>$notice_model,]);
    }

    public function actionUpdate($id) //редактирование объявления
    {
      $update_model = Post::find()->where(['id'=>$id])->one();

        if ($update_model->load(Yii::$app->request->post()) && $update_model->validate())
        {
          $update_model->image = UploadedFile::getInstance($update_model, 'image');
          $update_model->save();

        }

        return $this->render('update',['update_model'=>$update_model]);
    }

    public function actionView($id) //Просмотреть объявление
    {
        $notice_model = Post::find()->where(['id' => $id])->all(); //заносим данные текущего обявления в переменную $notice_model

        $user_id = ArrayHelper::getColumn($notice_model, 'user_id'); // в $user_id записывает значения столбца user_id

        $count_notice = Post::find()->where(['user_id'=>$user_id])->count();// записываем в переменну  $count_notice количество запсией пользователя

        $user_model = Profile::find()->where(['user_id' => $user_id])->one();//заносим данные текущего пользователя в переменную $user_model


        return $this->render('view',
          [
            'notice_model'=>$notice_model,
            'user_model'=>$user_model,
            'count'=>$count_notice,
          ]);
    }

      public function actionClose($id) //удалени
      {
        $post = Post::findOne($id);
        $post->isActive = false;
        $post->update();
        return $this->redirect(['notice']);
      }
    public function actionOpen($id) //удалени
    {
      $post = Post::findOne($id);
      $post->isActive = true;
      $post->update();
      return $this->redirect(['notice']);
    }
}
