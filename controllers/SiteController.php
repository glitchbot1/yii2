<?php

namespace app\controllers;
use app\models\Post;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
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
      public function actions()
      {
        return [
          'error' => [
            'class' => 'yii\web\ErrorAction',
          ],
          'captcha' => [
            'class' => 'yii\captcha\CaptchaAction',
            'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
          ],
        ];
      }

      public function beforeAction($action) //Метод вызавается перед вызовым страницы
      {
        $model_search = new SiteSearch(); // Создаем модель
        if($model_search->load(Yii::$app->request->post()) && $model_search->validate()) {
          $search = Html::encode($model_search->search);
          return $this->redirect(Yii::$app->urlManager->createUrl(['site/search','search'=>$search]));
        }
        return true;
      }

      public function actionSearch() // Поиск объявлений
      {
        $search = Yii::$app->request->get('search');
        $query = Post::find()->where(['ilike','title',$search]);
        $pages = new Pagination(['totalCount' => $query->count()]);
        $model = $query->offset($pages->offset)->limit($pages->limit)->orderBy('date DESC')->all();

        return $this->render('search',[
          'model'=>$model,
          'pages'=>$pages,
          'search'=>$search,
        ]);
      }
      //Вывод всех объявлений на главную страницу и пагинация
       public function actionIndex()
      {

        $categories= Category::find()->all();
        $cities = City::find()->all();

        if (isset($_GET['category'])) {
          $category = Category::find()->where(['title'=>$_GET['category']])->all();
          $cat_id = ArrayHelper::getColumn($category,'id');
          $posts = Post::find()->where(['category_id'=>$cat_id,'isActive'=>true]);
        }

        if (isset($_GET['city'])) {
          $city = City::find()->where(['city'=>$_GET['city']])->all();
          $city_id = ArrayHelper::getColumn($city,'id');
          $posts = Post::find()->where(['city_id'=>$city_id,'isActive'=>true]);
        }

        if (isset($_GET['category']) && isset($_GET['city']) ) {
          $category = Category::find()->where(['title'=>$_GET['category']])->all();
          $cat_id = ArrayHelper::getColumn($category,'id');
          $city = City::find()->where(['city'=>$_GET['city']])->all();
          $city_id = ArrayHelper::getColumn($city,'id');
          $posts = Post::find()->where(['city_id'=>$city_id,'category_id'=>$cat_id,'isActive'=>true]);
        }

        if (!isset($_GET['category']) && !isset($_GET['city']) ) {
          $posts = Post::find()->where(['isActive'=>true,]);

        }

        $pages = new Pagination(['totalCount' => $posts->count()]);
        $model = $posts->offset($pages->offset)->limit($pages->limit)->orderBy('date DESC')->all();

        return $this->render('index',[
          'model'=>$model,
          'pages'=>$pages,
          'categories'=>$categories,
          'cities'=>$cities,

        ]);
      }




}
