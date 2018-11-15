<?php

namespace app\controllers;
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
              'access' => [
                  'class' => AccessControl::className(),
                  'only' => ['logout'],
                  'rules' => [
                      [
                          'actions' => ['logout'],
                          'allow' => true,
                          'roles' => ['@'],
                      ],
                      [
                      'actions' => ['profile'],
                      'allow' => true,
                      'roles' => ['@'],
                      ],
               ],

              ],
              'verbs' => [
                  'class' => VerbFilter::className(),
                  'actions' => [
                      'logout' => ['post'],
                      'profile' => ['post'],
                  ],
              ],

          ];
      }
    public function actionProfile()  // action личный профиль
    {
        $profile_model = ($profile_model = Profile::findOne(Yii::$app->user->id)) ? $profile_model : new Profile();
        //Если данные текущего пользователя найдены заносим их в объект $profile_model, иначе создаем новый объект.
            if ($profile_model->load(Yii::$app->request->post()) && $profile_model->validate()):
                //если форма была отправлена, то даные с формы загружаются в объект модели и проверяем на валидногсть

                $profile_model->photo = UploadedFile::getInstance($profile_model,'photo');

                if( $profile_model->updateProfile($profile_model) && $profile_model->upload()):// вызываем метод их модели,если запись данных прошла успешно

                    Yii::$app->session->setFlash('success', 'Профиль изменен');
                else:// запись если  произошла ошибка
                    Yii::$app->session->setFlash('error', 'Профиль не измененн');
                return $this->refresh(); // перезагрузка страницы
                endif;
            endif;
        return $this->render('profile',['profile_model'=>$profile_model]);

    }


    public function actionSignup()  // action регистрации
    {
        $model = new Signup();

        if(Yii::$app->request->isPjax) {

            if (isset($_POST['Signup'])) {
                $model->attributes = Yii::$app->request->post('Signup');

                if ($model->validate() && $model->signup()) {

                    return $this->goHome();

                }

            }
        }

        return $this->render('signup',['model'=>$model]);
    }
    public function actionLogin()   // action авторизации
    {
        $login_model = new Login();
            if(Yii::$app->request->isPjax)
            {
                if (Yii::$app->request->post('Login')) {

                    $login_model->attributes = Yii::$app->request->post('Login');

                    if ($login_model->validate()) {
                        Yii::$app->user->login($login_model->getUser());
                        return $this->goHome();
                    }

                }
            }
            return $this->render('login', ['login_model' => $login_model]);// action выход
    }

    public  function actionLogout()  // выход из сессии
    {
        if(!Yii::$app->user->isGuest) {

            Yii::$app->user->logout();
            return $this->redirect('login');
        }
    }
    public function actionPost()
    {

        return $this->render('index');
    }




    public function actionIndex()
    {
        return $this->render('index');
    }




}
