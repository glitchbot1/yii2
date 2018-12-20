<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

\app\assets\AppAsset::register($this);
?>

  <h1 class="text-center">Добавить объявление</h1>
  <?php if( Yii::$app->session->hasFlash('success') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
  <?php endif;?>

  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <?php $form=ActiveForm::begin([
        'id'=>'post_form',
        'class'=>'form-horizontal',
        ])?>

      <?php $items_category = ArrayHelper::map($category, 'id','title');?>
      <?php $items_city = ArrayHelper::map($city, 'id','city');?>
      <?php $params = ['prompt'=> ' ']?>
      <?= $form->field($post_model,'title')->textInput() ?>
      <?= $form->field($post_model,'category_id')->dropDownList($items_category,$params)?>
      <?= $form->field($post_model,'description')->textarea(['rows'=>5]) ?>
      <?= $form->field($post_model,'city_id')->dropDownList($items_city,$params)?>
        <?= $form->field($post_model,'price')->textInput() ?>
        <label for="input-file" class="btn btn-success">Загрузить</label>
        <div class="rule_post_image">
        <p class="p_text_image">Вы можете загрузить фотографию в формате jpeg, jpg, png и весом не более 10 Мб</p>
        </div>
        <?= $form->field($post_model,'image')->fileInput(['class'=>'uploading-file', 'id'=>'input-file'])?>
        <div>
          <img class="post__image" id="img-preview" src="<?= Url::toRoute(['uploads/image_post/no-photo.png'])?>"/>
        </div>
        <div>
          <input type="reset" class="btn btn-danger" value="Отмена">
        </div>
        <?= Html::submitButton('Добавить',['class'=> 'btn btn-success button_update_post'])?>
      <?php ActiveForm::end()?>
    </div>
  <div class="col-md-2"></div>
</div>