<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;

?>
  <?php Pjax::begin()?>
  <?php $form=ActiveForm::begin([
    'id'=>'info-form',
    'options'=>[
      'class'=>'form-horizontal',
      //'data-pjax'=>true,

    ],
    'fieldConfig'=>[
      'template'=> '<div class="col-md-2">{label}</div><div class="col-md-7">{input}</div><div class="col-md-9">{error}</div>',
    ],
  ]) ?>

  <div class="main-profile">
    <h1 class="text-center">Личные данные</h1>
    <div class="container">
      <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-sm-3 col-md-2 col-lg-2">

            <?php if ($profile_model->img) :  ?>
              <a class="glyphicon glyphicon glyphicon-remove" href="<? echo Url::to(['user/delete-image-profile', 'id' => $profile_model->user_id]) ?>"></a>
              <img class="profile__image" src="<?= Url::toRoute('/image?file='. $profile_model->img)?>" alt="fdg">
              <label for="input-file"  class="btn btn-success">Изменить</label>
              <?= $form->field($profile_model, 'photo')->fileInput(['class'=>'uploading-file', 'id'=>'input-file']) ?>
            <?php else :  ?>
              <img class="profile__image" src="<?= Url::toRoute(['uploads/image_profile/cap.jpg'])?>" alt="cap">
              <label for="input-file"  class="btn btn-success">Загрузить</label>
              <?= $form->field($profile_model, 'photo')->fileInput(['class'=>'uploading-file','id'=>'input-file']) ?>
          <?php endif; ?>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8">
          <?php $items_city = ArrayHelper::map($city,'id','city')?>
          <?php $params = ['prompt'=>'']?>
          <?= $form->field($profile_model,'name') ?>
          <?= $form->field($profile_model,'city_id')->dropDownList($items_city, $params)?>
          <?= $form->field($profile_model,'phone')->textInput(['maxlength'=>10,'placeholder'=>'Телефон должен быть 10 цифр']) ?>
          <?= $form->field($profile_model,'description')->textarea(['rows'=>6]) ?>
          <?= Html::submitButton('Сохранить', ['class' => 'profile__btn_save btn btn-primary']) ?>

        </div>
      </div>
    </div>

    <?php if( Yii::$app->session->hasFlash('success') ): ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
      </div>
    <?php endif;?>
  <?php ActiveForm::end()?>
  <?php Pjax::end()?>

