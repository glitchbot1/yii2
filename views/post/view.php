  <div class="container">
    <div class="row">
    <div class="col-md-5">
      <?php foreach($notice_model as $notice): ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <p>Объявление/<?= $notice->category->title ?></p>
          <p><?= $notice->title?><strong> Цена:</strong><?= $notice->price?></p>
          <p><?= $notice->date?><strong> Город:</strong><?= $notice->city->city ?></p>
          <p><?= $notice->description?></p>
          <?php if($notice->img) : ?>
          <img  class="post__image" src="/post/<?= $notice->img?>" alt="fdg">
          <?php  else : ?>
          <img class="post__image" src="/image/no-photo.png" alt="cap">
          <?php endif; ?>
          <?php endforeach; ?>
         </div>
        </div>
      </div>


<div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-body">
        <img class="post__image" src="/image/<?= $user_model->img?>" alt="fdg">
        <p><?= $user_model->name ?></p>
        <p><?= $user_model->dateRegistration?></p>
        <p><strong>Объявлений: <p><?= $count?></p>
        <p><?= $user_model->phone?>
        <p><?= $user_model->description?></p>
        </div>
      </div>
  </div>
</div>