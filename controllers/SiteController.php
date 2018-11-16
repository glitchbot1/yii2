<?php

namespace app\controllers;
use app\models\Post;
use Yii;
use yii\filters\AccessControl;
use app\models\Profile;
use app\models\Signup;
use yii\filters\VerbFilter;
use app\models\Login;
use yii\web\Controller;
use yii\web\UploadedFile;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
      public function behaviors()
      {
          return [


          ];
      }



    public function actionIndex()
    {

      return $this->render('index');
    }


}
