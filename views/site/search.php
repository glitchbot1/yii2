
    <?php if ($search == "") { ?>
         <h4> Вы ничего не ввели</h4>
    <?php } else { ?>
        <h4> Результат: <?=$search?></h4>
    <?php if(!$model){?>
        <h4> Ничего не найдено</h4>
    <?php } else { ?>
     <?php foreach ($model as $posts):?>
        <div class="col-lg-6 post">
          <img class="post__image" src="/post/<?= $posts->image?>" alt="Фото">
          <a  href="<?php echo Yii::$app->urlManager->createUrl(['post/view', 'id' => $posts['id']]); ?>">
            <p><?php echo $posts['title']?> </p></a>
          <p>Цена: <?= $posts->price ?></p>
          <p><?= $posts->date ?></p>
        </div>
      <?php endforeach; ?>
      <?php }?>
    <?php }?>
