
<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use \yii\helpers\ArrayHelper;
use app\models\City;
use app\models\Category;
use yii\widgets\LinkPager;
?>
    <h1 class="text-center">Мои объявления</h1>
      <div class="col-md-6">
        <select onchange="window.location.search += 'category=' + this.options[this.selectedIndex].value + '&'"
          class="btn btn-primary"
          size="1"
          name="category"
          id="category">
          <option disabled selected>Категория</option>
          <?php foreach ($categories as $category ):?>
            <option value="<?= $category->title?>"> <?= $category->title?> </option>
          <?php endforeach;?>
        </select>
        <select onchange="window.location.search += 'status=' + this.options[this.selectedIndex].value + '&'"
          class="btn btn-primary"
          size="1" name="city"
          id="city">>
          <option disabled selected>Статус</option>
          <option value="active">Активное</option>
          <option value="close">Закрытое</option>
        </select>
      </div>
    <div class="col-md-4 pull-right">
      <form action="<?= Url::to(['/site/search']) ?>" class="form-inline">
        <div class="form-group">
          <label for="searchField" class="sr-only"></label>
          <div class="input-group">
            <input
              type="text"
              class="form-control"
              id="searchField"
              placeholder="Search..."
              name="search"
            />
          </div>
        </div>
        <button class="btn btn-success" type="submit">
          <span class="glyphicon glyphicon-search"></span>
        </button>
      </form>
    </div>
    </div>
  <div class="container">
    <?php if( Yii::$app->session->hasFlash('success') ): ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
      </div>
    <?php endif;?>
    <?php foreach ($notice_model as $notice): ?>
    <div class="row">
      <div class="col-md-8">
        <h2>
          <?= $notice->title ?>
          <?php if($notice->isActive):?>
            <a class="glyphicon glyphicon-pencil btn-default" href="<? echo Url::to(['post/update', 'id' => $notice->id]) ?>"></a>
            <a class="btn btn-default" href="<? echo Url::to(['post/close', 'id' => $notice->id]) ?>">Закрыть</a>
          <?php else:?>
            <a class="btn btn-default" href="<? echo Url::to(['post/open', 'id' => $notice->id]) ?>">Открыть</a>
          <?php endif;?>
            Статус:<?php if($notice->isActive): ?>Активное<?php else: ?> Закрытое<?php endif; ?>

        </h2>
        <ul class="list-inline">
          <li><?= $notice->date ?></li>
          <li>Категория: <?= $notice->category->title ?></li>
          <li>Город: <?= $notice->city->city ?></li>
        </ul>
      </div>
    </div>

      <div class="col-md-8">
      <p class="lead"><?= $notice->description ?></p>
      </div>
      <h4>Цена: <?= $notice->price ?>руб</h4>
      <img class="post__image" src="/post/<?= $notice->img?>" alt=""/>
      <? endforeach;?>
  </div>
<?= LinkPager::widget([
  'pagination'=>$pages
])?>
