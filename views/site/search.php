<?php
use yii\helpers\Url;
?>
    <?php if ($search == ""): ?>
        <h4> Вы ничего не ввели</h4>
    <?php  else:?>
        <h4> Результат: <?=$search?></h4>
    <?php endif; ?>
    <?php if(!$model):?>
        <h4> Ничего не найдено</h4>
    <?php else: ?>
     <?php foreach ($model as $posts):?>
        <div class="col-lg-6 ">
          <div class="post-border">
          <?php if ($posts->img): ?>
          <img class="post__image" src="<?= Url::toRoute(['uploads/image_post/'.$posts->img])?>" alt="Фото">
          <?php else: ?>
            <img class="post__image" src="<?= Url::toRoute(['uploads/image_post/no-photo.png'])?>"/>
          <?php endif; ?>
          <a style="text-decoration: none;"  href="<?= Yii::$app->urlManager->createUrl(['post/view', 'id' => $posts['id']]); ?>">
            <p class="title-index"><?= $posts->title?> </p></a>
          <p>Цена: <?= $posts->price ?></p>
          <p><?= $posts->date ?></p>
        </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
