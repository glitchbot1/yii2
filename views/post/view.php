
<?php foreach($notice_model as $notice): ?>

      <p><?= $notice->category->title ?></p>
      <p><?= $notice->city->city ?>
<?php endforeach; ?>