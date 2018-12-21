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

  public function actionIndex($file,$width,$height)
  {

    $width = isset($_GET['width']);
    $height = isset($_GET['height']) ? intval($_GET['height']) : null;

    // название файла
    $file = $_GET['file'];

    // $originalPath оригинальный путь к картинки
    $originalPath = (Yii::getAlias('@web') . 'uploads/image_profile/' . $file);

    // куда будем сохранять уже измененную
    $savePath = (Yii::getAlias('@web') . 'uploads/image_temp/' . $file);

    // $image_info содержит информацию о текущей картинки
    $image_info = getimagesize($originalPath);

    // перебираем типы данных и в соответсвии вызываем свою функцию для  изображения
    switch ($image_info['mime']) {
      case 'image/jpeg':
        if (imagetypes() & IMG_JPEG) {
          $image = imagecreatefromjpeg($originalPath);
        } else {
          $error = 'Ошибка ';
        }
        break;
      case 'image/jpg':
        if (imagetypes() & IMG_JPG) {
          $image = imagecreatefromjpeg($originalPath);
        } else {
          $error = 'Ошибка ';
        }
        break;
      case 'image/png':
        if (imagetypes() & IMG_PNG) {
          $image = imagecreatefrompng($originalPath);
        } else {
          $error = 'Ошибка ';
        }
        break;
      default:
        $error = 'Ошибка' . $image_info['mime'];
    }

    if (isset($error)) {
      return $error;
    }

    // $image_width = ширина текущей картинки
    $image_width = imagesx($image);
    //$image_height = высота текущей картинки
    $image_height = imagesy($image);

    $wV1 = $image_width;
    $hV1 = ($image_width / 2);

    $hV2 = $image_height;
    $wV2 = ($image_height / 2);

    $d1 = $image_height - $hV1;
    $d2 = $image_width - $wV2;

    if ($d1 < $d2) {
      $wV = $wV1;
      $hV = $hV1;
    } else {

      $wV = $wV2;
      $hV = $hV2;

    }
    $img = Image::getImagine()->open($originalPath)->thumbnail(new Box($wV, $hV))->save($savePath, ['quality' => 90]);
    header('Content-type: ' . basename($file));
    readfile($savePath);
    echo $file;

  }

}