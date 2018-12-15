<?php
use yii\helpers\Html;
use app\assets\AppAsset;
AppAsset::register($this);
?>

  <nav class="navbar navbar-collapse">
    <div class = "nav navbar-nav navbar-right  ">

      <?php if(Yii::$app->user->isGuest):?>
        <li>
          <?= Html::beginForm(['/site/index'], 'post')
          . Html::submitButton(
            'На главную',
            ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px; color:black; font-size: 17px;"]
          )
          . Html::endForm() ?>
        </li>
        <li>
          <?= Html::beginForm(['/user/login'], 'post')
          . Html::submitButton(
            'Войти',
            ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px; color:black; font-size: 17px;"]
          )
          . Html::endForm() ?>
        </li>
        <li>
          <?= Html::beginForm(['/user/signup'], 'post')
          . Html::submitButton(
            'Регистрация',
            ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px; color:black; font-size: 17px;"]
          )
          . Html::endForm() ?>
        </li>

      <?php else: ?>
        <li>
          <?= Html::beginForm(['/site/index'], 'post')
          . Html::submitButton(
            'На главную',
            ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px; color:black; font-size: 17px;"]
          )
          . Html::endForm() ?>
        </li>
        <li>
          <?= Html::beginForm(['/post/post'], 'post')
          . Html::submitButton(
            'Добавить объявление',
            ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px; color:black; font-size: 17px;" ]
          )
          . Html::endForm() ?>
        </li>
        <li>
          <?= Html::beginForm(['/post/notice'], 'post')
          . Html::submitButton(
            'Мои объявления',
            ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px; color:black; font-size: 17px;"]
          )
          . Html::endForm() ?>
        </li>
        <li>
          <?= Html::beginForm(['/user/profile'], 'post')
          . Html::submitButton(
            'Личный кабинет',
            ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px; color:black; font-size: 17px;"]
          )
          . Html::endForm() ?>
        </li>
        <li>
          <?= Html::beginForm(['/user/logout'], 'post')
          . Html::submitButton(
            'Выйти (' . Yii::$app->user->identity->email . ')',
            ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px; color:black; font-size: 17px;"])
          . Html::endForm() ?>
        </li>
      <?php endif;?>
    </div>
  </nav>