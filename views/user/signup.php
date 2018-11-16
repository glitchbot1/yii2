<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
?>

<?php Pjax::begin() ?>
<?php $form=ActiveForm::begin([
    'id'=>'registration-form',
    'options'=>[
        'class' =>'form-horizontal',
        'data-pjax'=> true,
        ],
    'fieldConfig'=>[
        'template'=> '<div class="col-md-12">{label}</div><div class="col-md-3">{input}</div><div class="col-md-">{error}</div>',
    ]
]);?>

    <?= $form->field($model,'email')?>
    <?= $form->field($model,'password')->passwordInput()?>
    <?= Html::submitButton('Зарегистрироваться') ?>

<?php ActiveForm::end()?>
<?php Pjax::end() ?>