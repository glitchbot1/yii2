<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use \yii\widgets\ActiveField;

?>

<?php $form=ActiveForm::begin()?>
<img class="post__image" src="/post/<?= $update_model->image?>" alt="fdg">
<?= $form->field($update_model,'title')->textInput() ?>
<?= $form->field($update_model,'category_id')->dropDownList(ArrayHelper::map(\app\models\Category::find()->all(), 'id','title'))?>
<?= $form->field($update_model,'description')->textarea(['rows'=>5]) ?>
<?= $form->field($update_model,'city_id')->dropDownList(ArrayHelper::map(\app\models\City::find()->all(), 'id','city'))?>
<?= $form->field($update_model,'price')->textInput() ?>
<?= $form->field($update_model,'image')->fileInput()?>
<?php echo Html::a('<span class="glyphicon glyphicon-trash"></span>', ['post/update', 'id' => $update_model->id]); ?>
<?= Html::submitButton('Сохранить изменения',['class'=> 'btn btn-success'])?>
<?php ActiveForm::end()?>
