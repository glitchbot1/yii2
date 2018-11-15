<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class TestController extends Controller
{
  public function behaviors(){
    return [
      'access' => [
        'class' => AccessControl::className(),
        'rules' => [
          [
            'allow' => true,
            'controllers' => ['admin/default'],
            'actions' => ['@'],
          ],

        ],
      ],
    ];
  }
}