<?php
namespace app\components;
use yii\base\Widget;

class NavBarWidget extends Widget {

  public function run()
  {
   return $this->render('NavBar');
  }
}