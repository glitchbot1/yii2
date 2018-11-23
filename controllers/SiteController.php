<?php

namespace app\controllers;
use app\models\Post;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\City;
use app\models\SiteSearch;
use app\models\Category;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{
      public function behaviors()
      {
          return [


          ];
      }

      public function beforeAction($action)
      {
        $model_search = new SiteSearch();
        if($model_search->load(Yii::$app->request->post()) && $model_search->validate())
        {
          $search = Html::encode($model_search->search);
          return $this->redirect(Yii::$app->urlManager->createUrl(['site/search','search'=>$search]));
        }
        return true;
      }

      public function actionSearch()
      {
        $search = Yii::$app->request->get('search');
        $query = Post::find()->where(['like','title',$search]);
        $pages = new Pagination(['totalCount' => $query->count()]);
        $model = $query->offset($pages->offset)->limit($pages->limit)->orderBy('date DESC')->all();

        return $this->render('search',[
          'model'=>$model,
          'pages'=>$pages,
          'search'=>$search,
        ]);
      }

       public function actionIndex()
      {

          $query = Post::find();
          $pages = new Pagination(['totalCount' => $query->count()]);
          $model = $query->offset($pages->offset)->limit($pages->limit)->orderBy('date DESC')->all();

        return $this->render('index',[
          'model'=>$model,
          'pages'=>$pages,

        ]);
      }



}
