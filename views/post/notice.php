
<?php

?>
  <?php foreach ($notice_model as $notice): ?>
    <img class="notice__image" src="/post/<?= $notice->image?>" alt="fdg">
    <?= $notice->title ?>
    <?= $notice->price ?>
    <?= $notice->description ?>
    <?= $notice->date ?>


<? endforeach;?>

