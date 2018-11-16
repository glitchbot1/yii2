<?php
namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\models\Post;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class PostController extends Controller{

    public function actionPost()
    {
      $post_model = ($post_model = Post::findOne(Yii::$app->user->id))? $post_model : new Post();

         if ($post_model->load(Yii::$app->request->post()) && $post_model->validate()):

           $post_model->image = UploadedFile::getInstance($post_model, 'image');

           if ($post_model->updatePost($post_model) && $post_model->updateImage()):
             Yii::$app->session->setFlash('success', 'Обновлениепрошло успешно');
           else:
             Yii::$app->session->setFlash('error', 'Ошибка');
           endif;
         endif;
         return $this->render('post', ['post_model' => $post_model]);

    }

    public function actionNotice()
    {

      return $this->render('notice');
    }

}