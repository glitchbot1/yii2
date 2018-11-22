<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use app\models\SiteSearch;
use yii\helpers\Url;
use app\models\Category;
\app\assets\SiteAsset::register($this);
?>


<?php //$form = ActiveForm::begin();?>
<?//= $form->field($model,'category_id')->dropDownList(\app\models\Category::find()->asArray()->all())?>
<?php //  ActiveForm::end()?>

<div class="row p-5 bg-info">
  <div class="col-md-6">
    <select
      class="btn btn-primary"
      size="1"
      name="category"
      id="category"
    >
      <option disabled selected>Категория</option>
      <option value="Недвижимость">Недвижимость</option>
    </select>

    <select class="btn btn-primary" size="1" name="city" id="city">
      <option disabled selected>Город</option>
      <option value="South Eldoramouth">South Eldoramouth</option>
    </select>
  </div>

  <div class="col-md-4 pull-right">
    <form action="<?= Url::to(['/site/search']) ?>" class="form-inline">
      <div class="form-group">
        <label for="searchField" class="sr-only"></label>
        <div class="input-group">
          <input
            type="text"
            class="form-control"
            id="searchField"
            placeholder="Search..."
            name="search"
          />
        </div>
      </div>
      <button class="btn btn-success" type="submit">
        <span class="glyphicon glyphicon-search"></span>
      </button>
    </form>
  </div>
</div>

<div class="row text-center">
  <div class="col-md-12"><h1>Актуальные объявления</h1></div>
</div>

  <div class="row">
    <?php foreach ($model as $posts): ?>
              <div class="col-md-6">
                <img class="post__image" src="/post/<?= $posts->image?>" alt="Фото">
                <a  href="<?php echo Yii::$app->urlManager->createUrl(['post/view', 'id' => $posts['id']]); ?>">
                <p><?php echo $posts['title']?> </p></a>
               <p>Цена: <?= $posts->price ?></p>
               <p><?= $posts->date ?></p>
              </div>
    <? endforeach;?>
  </div>
  <?= LinkPager::widget([
    'pagination'=>$pages
  ])?>

