<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;
\app\assets\SiteAsset::register($this);
?>

<div class="row p-5 bg-info">
  <div class="col-md-6">
    <form action="/site/index" method="get">
    <select class="btn btn-primary"  name="category" id="category" onchange="this.form.submit()">
    <option disabled <?php  if (!isset($_GET['category'])) {echo 'selected';}?>>Категория</option>
      <?php foreach ($categories as $category ):?>
        <option <?php  if (isset($_GET['category']) && $_GET['category'] == $category->title) {echo 'selected';}?> value="<?= $category->title?>"> <?= $category->title?> </option>
      <?php endforeach;?>
    </select>
    <select class="btn btn-primary" name="city" id="city" onchange="this.form.submit()">
      <option disabled <?php  if (!isset($_GET['city'])) {echo 'selected';}?>>Город</option>
      <?php foreach ($cities as $city ):?>
        <option <?php if (isset($_GET['city']) && $_GET['city'] == $city->city) {echo 'selected';}?>  value="<?= $city->city?>"> <?= $city->city?> </option>
      <?php endforeach;?>

    </select>
    </form>
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
<div class="row text-center">
  <div class="col-md-12"><h1>Актуальные объявления</h1></div>
</div>
  <div class="row">
    <?php foreach ($model as $posts): ?>
          <div class="col-md-6">
            <a  href="<?php echo Yii::$app->urlManager->createUrl(['post/view', 'id' => $posts['id']]); ?>">
                <?php if($posts->img){  ?>
                <img class="post__image" src="/post/<?= $posts->img?>" alt="Фото">
                <?php } else {  ?>
                  <img class="post__image" src="/post/no-photo.png" alt="cap">
                <?php }  ?>
                <p><?php echo $posts['title']?> </p></a>
               <p>Цена: <?= $posts->price ?></p>
               <p><?= $posts->date ?></p>
              </div>
    <? endforeach;?>
  </div>
  <?= LinkPager::widget([
    'pagination'=>$pages
  ])?>

