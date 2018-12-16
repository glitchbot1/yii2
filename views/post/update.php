<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  use \yii\helpers\ArrayHelper;
  use \yii\widgets\ActiveField;
  use yii\helpers\Url;
\app\assets\AppAsset::register($this);
?>

  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <h1 class="text-center">Изменить объявление</h1>
      <?php $form=ActiveForm::begin()?>
        <?= $form->field($update_model,'title')->textInput() ?>
        <?= $form->field($update_model,'category_id')->dropDownList(ArrayHelper::map(\app\models\Category::find()->all(), 'id','title'))?>
        <?= $form->field($update_model,'description')->textarea(['rows'=>5]) ?>
        <?= $form->field($update_model,'city_id')->dropDownList(ArrayHelper::map(\app\models\City::find()->all(), 'id','city'))?>
        <?= $form->field($update_model,'price')->textInput() ?>
        <div class="img_wrapper">
        </div>
        <label for="input-file"  class="btn btn-success">Загрузить</label>
        <div class="rule_post_image">
          <p class="p_text_image">Вы можете загрузить фотографию в формате jpeg, jpg, png и весом не более 10 Мб</p>
        </div>
        <?php if($update_model->img): ?>
          <a class="glyphicon glyphicon glyphicon-remove" href="<? echo Url::to(['post/delete-image', 'id' => $update_model->id]) ?>"></a>
          <img class="post__image " src="<?= Url::toRoute(['uploads/image_post/'.$update_model->img])?>" alt="image">
        <?php else: ?>
          <div>
            <img class="post__image" id="img-preview" src="<?= Url::toRoute(['uploads/image_post/no-photo.png'])?>"/>
          </div>
          <div>
            <input type="reset" class="btn btn-danger" value="Отмена">
          </div>
        <?php endif; ?>
        <?= $form->field($update_model,'image')->fileInput(['class'=>'uploading-file', 'id'=>'input-file'])?>
        <?= Html::submitButton('Сохранить изменения ',['class'=> 'btn btn-success button_update_post'])?>
      <?php ActiveForm::end()?>
    </div>
    <div class="col-md-2"></div>
  </div>