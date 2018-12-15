<?php
namespace app\controllers;
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class ImageController extends Controller
{

  public function actionIndex($file)
  {

    $name = $file;
    // записали оригинал  файла $img
    if (!file_exists(Yii::getAlias('@web') . 'uploads/image_temp/' . $name)) {

      //получили оригинал картинки
      $img = Image::getImagine()->open(Yii::getAlias('@web') . 'uploads/image_profile/' . $name);
      //получили размер картинки
      $size = $img->getSize();
      //поделили ширину с высотой пропорционально
      $proportion = $size->getWidth()/$size->getWidth();
      $width = 200;
      // новый размер картинки
      $height = round($width/$proportion);
      $new_size = new Box($width,$height);
      // сжали и сохранили в папку
      $img->resize($new_size)->save(Yii::getAlias('@web') . 'uploads/image_temp/' . $name, ['quality' => 100]);

    }
    //передали файл в header
    $file = file_get_contents(Yii::getAlias('@web') . 'uploads/image_temp/' . $name);
    return $file;

  }
}