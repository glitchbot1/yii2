<?php
namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\models\Post;
use app\models\City;
use app\models\Category;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

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

    public function actionPost()
    {
        $post_model=new Post();

        if ($post_model->load(Yii::$app->request->post()) && $post_model->validate()):

          $post_model->image = UploadedFile::getInstance($post_model, 'image');

          if ($post_model->createPost($post_model) && $post_model->updateImage()):

                Yii::$app->session->setFlash('success', 'Объявление успешно добавлено');
           // return $this->redirect(['site/index']);
          else:

                Yii::$app->session->setFlash('error', 'Ошибка');
          endif;
        endif;

        return $this->render('post', ['post_model' => $post_model]);
    }

    public function actionNotice()
    {

        $notice_model = Post::find()->where(['user_id'=>Yii::$app->user->id])->all();

        return $this->render('notice',['notice_model'=>$notice_model,]);
    }

    public function actionView()
    {

        $notice_model = Post::find()->where(['id' => Yii::$app->request->get()])->all();

        return $this->render('view',['notice_model'=>$notice_model,

        ]);
    }


}
