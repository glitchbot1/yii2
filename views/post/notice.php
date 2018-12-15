
<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
    <h1 class="text-center">Мои объявления</h1>
<div class="row p-5 bg-info">
  <div class="col-md-6">
    <form action="/post/notice" method="get">
      <select class="btn btn-primary"  name="category" id="category" onchange="this.form.submit()">
        <option disabled <?php  if (!isset($_GET['category'])) {echo 'selected';}?>>Категория</option>
        <?php foreach ($categories as $category ):?>
          <option <?php  if (isset($_GET['category']) && $_GET['category'] == $category->title) {echo 'selected';}?> value="<?= $category->title?>"> <?= $category->title?> </option>
        <?php endforeach;?>
      </select>
      <select onchange="this.form.submit()"
              class="btn btn-primary" name="status" id="status">>
        <option disabled selected>Статус</option>
        <option value="active">Активное</option>
        <option value="close">Закрытое</option>
      </select>
    </form>
  </div>
  <div class="col-md-4 pull-right">
    <form action="<?= Url::to(['/site/search']) ?>" class="form-inline">
      <div class="form-group">
        <label for="searchField" class="sr-only"></label>
        <div class="input-group">
          <input type="text" class="form-control" id="searchField" placeholder="Поиск..." name="search"
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
      <?php if ($notice->img): ?>
      <img class="post__image" src="<?= Url::toRoute(['uploads/image_post/'.$notice->img])?>" alt=""/>
      <?php else: ?>
      <img class="post__image" src="<?= Url::toRoute(['uploads/image_post/no-photo.png'])?>" alt="cap">
      <?php endif; ?>
      <? endforeach;?>
  </div>
<?= LinkPager::widget([
  'pagination'=>$pages
])?>
