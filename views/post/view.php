<?php
use yii\helpers\Url;
?>
  <div class="container">
    <div class="row">
    <div class="col-md-5">
      <?php foreach($notice_model as $notice): ?>
        <div class="panel-body">
          <p>Объявления/<?= $notice->category->title ?></p>
          <p><strong class="title_view"><?= $notice->title?></strong><strong> Цена:</strong><?= $notice->price?></p>
          <p><strong> <?= $notice->date?> Город:</strong><?= $notice->city->city ?></p>
          <?php if($notice->img) : ?>
          <img  class="post__image" src="<?= Url::toRoute(['uploads/image_post/'.$notice->img])?>" alt="fdg">
          <?php  else : ?>
          <img class="post__image" src="<?= Url::toRoute(['uploads/image_post/no-photo.png'])?>" alt="cap">
          <?php endif; ?>
          <p><?= $notice->description?></p>
          <?php endforeach; ?>
         </div>

      </div>


<div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-body">
        <img class="profile__image" src="<?= Url::toRoute(['/image?file='. $user_model->img])?>" alt="fdg">
        <p><strong> Имя: </strong><?= $user_model->name ?></p>
        <p><strong> На сайте: </strong><?= $user_model->dateRegistration?></p>
        <p><strong> Объявлений: <?= $count?></p>
        <p><strong> Телефон: </strong><?= $user_model->phone?>
        <p><strong> О себе: </strong><?= $user_model->description?></p>
        </div>
      </div>
  </div>
</div>