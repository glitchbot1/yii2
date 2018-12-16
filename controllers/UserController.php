<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use app\models\Profile;
use app\models\Signup;
use yii\filters\VerbFilter;
use app\models\Login;
use app\models\City;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\widgets\Pjax;


class UserController extends Controller
{

      public function behaviors()
      {
        return [
          'access' => [
              'class' => AccessControl::className(),
              'only' => ['profile','signup','login','logout'],
              'rules' => [
              [
                'allow' => true,
                'actions' => ['profile','logout'],
                'roles' => ['@'],
              ],
              [
                'allow' => true,
                'actions' => ['signup','login'],
                'roles' => ['?'],
              ],

            ],

          ],
        ];
      }

      public function actionProfile()  // Личный профиль
      {
        $city = City::find()->all();
        $profile_model = ($profile_model = Profile::findOne(Yii::$app->user->id)) ? $profile_model : new Profile();
        //Если данные текущего пользователя найдены заносим их в объект $profile_model, иначе создаем новый объект.

        if ($profile_model->load(Yii::$app->request->post()) && $profile_model->validate()) {
          //Если форма была отправлена, то даные с формы загружаются в объект модели и проверяем на валидногсть

          $photo = UploadedFile::getInstance($profile_model, 'photo');
            if(!is_null($photo)) {
              $profile_model->img = $profile_model->uploadImage($photo);
            }
             if ($profile_model->save()) {
               // Вызываем метод  модели,если запись данных прошла успешно
              Yii::$app->session->setFlash('success', 'Профиль изменен');

            }
            else { // Запись если  произошла ошибка
              Yii::$app->session->setFlash('error', 'Профиль не измененн');
            }

        }
        return $this->render('profile',['profile_model'=>$profile_model,'city'=>$city]);
      }


      public function actionSignup()  // Регистрации
      {
        $model = new Signup();
        if(Yii::$app->request->isPjax) {
          if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->signup()) {
              return $this->redirect('login');
            }
          }
        }
      return $this->render('signup',['model'=>$model]);
      }

      public function actionLogin()   //Авторизации
      {
        $login_model = new Login();

        if(Yii::$app->request->isPjax) {
          if ($login_model->load(Yii::$app->request->post()) && $login_model->validate()) {
              Yii::$app->user->login($login_model->getUser());

              return $this->redirect('profile');
          }
        }
        return $this->render('login', ['login_model' => $login_model]);// action выход
      }


      public  function actionLogout()  // Выход из сессии
      {
        if(!Yii::$app->user->isGuest) {
          Yii::$app->user->logout();
          return $this->redirect('login');
        }
      }

    public function actionDeleteImageProfile($id) // Удаление картинки
    {
      $delete = Profile::findOne($id);
      $file_name = $delete->img;
      //var_dump($file_name);
      if(file_exists($file_path = Yii::getAlias('@web').'uploads/image_profile/'. $file_name))
      {
        unlink(Yii::getAlias('@web').'uploads/image_profile/'.$file_name);
      }
      if($delete)
      {
        $delete->img = null;
        $delete->update();
      }
      Yii::$app->session->setFlash('success','Фотография удалена');
      return $this->redirect(['profile']);

    }
 }
