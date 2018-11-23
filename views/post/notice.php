
<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use \yii\helpers\ArrayHelper;
?>

<div class="container">
  <?php foreach ($notice_model as $notice): ?>
  <div class="row">
    <div class="col-md-8">
      <h2>
        <?= $notice->title ?>

        <a class="btn btn-default" href="<? echo Url::to(['post/delete', 'id' => $notice->id]) ?>">Закрыть</a>
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
          <li class="list-group-item">Статус: Активное</li>
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

