<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
?>
<h3 class="text-center">Регистрация</h3>
<div class="container">
  <div class="row">

    <?php Pjax::begin() ?>
    <?php $form=ActiveForm::begin([
        'id'=>'registration-form',
        'options'=>[
            'class' =>'form-horizontal',
            'data-pjax'=> true,
            ],
        'fieldConfig'=>[
          'template'=> '<div class="col-md-4">{label}</div><div class="col-md-3">{input}</div><div class="col-md-4">{error}</div>',
        ]
    ]);?>

        <?= $form->field($model,'email')?>
        <?= $form->field($model,'password')->passwordInput();?>
        <?= Html::submitButton('Зарегистрироваться',['class'=>'btn btn-success']); ?>

    <?php ActiveForm::end()?>
    <?php Pjax::end() ?>
      </div>
  </div>