<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\helpers\ArrayHelper;

?>

<h1>Добавить объявление</h1>

  <?php $form=ActiveForm::begin([
      'id'=>'post_form',
      'class'=>'form-horizontal',
      'fieldConfig'=>
      [
        'template'=>'<div class="col-md-6">{label}</div><div class="col-md-7">{input}</div><div class="col-md-7">{error}</div>',
      ],
    ])?>
      <div class="container">
        <div class="row">
          <img  src="post/<?= $post_model->image?>" alt="fdg">

          <div class="col-sm-8 col-md-8 col-lg-8">
            <?= $form->field($post_model,'title')->textInput() ?>
            <?= $form->field($post_model,'category_id')->dropDownList(ArrayHelper::map(\app\models\Category::find()->all(), 'id','title'))?>
            <?= $form->field($post_model,'description')->textarea(['rows'=>5]) ?>
            <?= $form->field($post_model,'city_id')->dropDownList(ArrayHelper::map(\app\models\City::find()->all(), 'id','city'))?>
            <?= $form->field($post_model,'price')->textInput() ?>
            <?= $form->field($post_model,'image')->fileInput()?>
            <?= Html::submitButton('Сохранить',['class'=> 'btn btn-success'])?>

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
