<?php


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>



<div class="wrap">
    <nav class="navbar navbar-light bg-danger">
    <div class = "nav navbar-nav navbar-right ">


        <?php if(Yii::$app->user->isGuest):?>
          <div class="navbar-brand mb-0 h1"> <a href="<?= Url::toRoute(['/site/login'])?>">Войти</a></div>

          <div class="navbar-brand mb-0 h1"><a href="<?= Url::toRoute(['/site/signup'])?>">Регистрация</a></div>
        <?php else: ?>
        <li>
            <?= Html::beginForm(['/site/profile'], 'post')
            . Html::submitButton(
                'Личный кабинет',
                ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px;"]
            )
            . Html::endForm() ?>
        </li>
        <li>
            <?= Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->email . ')',
                        ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px;"])
            . Html::endForm() ?>
        </li>
        <?php endif;?>
    </div>
    </nav>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
