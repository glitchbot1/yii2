
<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use \yii\helpers\ArrayHelper;
use app\models\City;
use app\models\Category;
?>
    <h1>Мои объявления</h1>
      <div class="col-md-6">
        <select
          class="btn btn-primary"
          size="1"
          name="category"
          id="category">
          <option disabled selected>Категория</option>
          <?php $categories = Category::find()->all() ;?>
          <?php foreach($categories as $categorie): ?>
            <option value="<?= $categorie->title?>"><?= $categorie->title?></option>
          <?php endforeach; ?>
        </select>
        <select class="btn btn-primary" size="1" name="city" id="city">
          <option disabled selected>Город</option>
          <?php $city = City::find()->all()?>
          <?php foreach ($city as $town): ?>
            <option value="<?= $town->city?>"><?= $town->city?></option>
          <?php endforeach; ?>
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
    <?php foreach ($notice_model as $notice): ?>
    <div class="row">
      <div class="col-md-8">
        <h2>
          <?= $notice->title ?>
          <?php if($notice->isActive):?>
          <a class="btn btn-default" href="<? echo Url::to(['post/close', 'id' => $notice->id]) ?>">Закрыть</a>
          <?php else:?>
            <a class="btn btn-default" href="<? echo Url::to(['post/open', 'id' => $notice->id]) ?>">Открыть</a>
          <?php endif;?>
          <a class="glyphicon glyphicon-pencil btn-default" href="<? echo Url::to(['post/update', 'id' => $notice->id]) ?>"></a>
        </h2>
        <ul class="list-inline">
          <li><?= $notice->date ?></li>
          <li>Категория: <?= $notice->category->title ?></li>
          <li>Город: <?= $notice->city->city ?></li>
        </ul>
        <p><?= $notice->description ?></p>
        <div class="col-md-4">
          <ul class="list-group mt-2">
            <li class="list-group-item">Статус: <?php if($notice->isActive){ ?>Активное<?php } else {?>Закрытое<?php }?></li>
            <li class="list-group-item">Цена: <?= $notice->price ?> руб</li>
            <li class="list-group-item">
              <img class="post__image" src="/post/<?= $notice->image?>" alt=""/>
            </li>
          </ul>
        </div>
      </div>
    </div>
      <? endforeach;?>
  </div>

