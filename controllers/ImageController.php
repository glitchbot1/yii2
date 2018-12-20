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


      if (!file_exists(Yii::getAlias('@web') . 'uploads/image_temp/' . $name)) {


         // записали оригинал  файла $img
          $img = Image::getImagine()->open(Yii::getAlias('@web') . 'uploads/image_profile/' . $name);
          //получили размер картинки
          $size = $img->getSize();
          //поделили ширину с высотой пропорционально
          $proportion = $size->getWidth() / $size->getHeight();
          $width = 200;
          // новый размер картинки
          $height = round($width / $proportion);
          $width = round($width / $proportion);
          $new_size = new Box($width, $height);
          // сжали и сохранили в папку
          $img->resize($new_size)->save(Yii::getAlias('@web') . 'uploads/image_temp/' . $name, ['quality' => 100]);
        }
        //передали файл в header
        $mime = $this->returnMIMEType($name);
        header('Content-type: ' . basename($mime));
        readfile(Yii::getAlias('@web') . 'uploads/image_temp/' . $name);
        echo $file;
      }




  public function returnMIMEType($filename) {

      // заданный шаблон файла, имя и расширение
      preg_match("|\.([a-z0-9]{2,4})$|i", $filename, $fileSuffix);

      switch(strtolower($fileSuffix[1]))
      {
        case "js" :
          return "application/x-javascript";

        case "json" :
          return "application/json";

        case "jpg" :
        case "jpeg" :
        case "jpe" :
          return "image/jpg";

        case "svg":
          return "image/svg+xml";

        case "png" :
        case "gif" :
        case "bmp" :
        case "tiff" :
          return "image/".strtolower($fileSuffix[1]);

        case "css" :
          return "text/css";

        case "xml" :
          return "application/xml";

        case "doc" :
        case "docx" :
          return "application/msword";

        case "xls" :
        case "xlt" :
        case "xlm" :
        case "xld" :
        case "xla" :
        case "xlc" :
        case "xlw" :
        case "xll" :
          return "application/vnd.ms-excel";

        case "ppt" :
        case "pps" :
          return "application/vnd.ms-powerpoint";

        case "rtf" :
          return "application/rtf";

        case "pdf" :
          return "application/pdf";

        case "html" :
        case "htm" :
        case "php" :
          return "text/html";

        case "txt" :
          return "text/plain";

        case "mpeg" :
        case "mpg" :
        case "mpe" :
          return "video/mpeg";

        case "mp4" :
          return "video/mp4";

        case "mp3" :
          return "audio/mpeg3";

        case "wav" :
          return "audio/wav";

        case "aiff" :
        case "aif" :
          return "audio/aiff";

        case "avi" :
          return "video/msvideo";

        case "wmv" :
          return "video/x-ms-wmv";

        case "mov" :
          return "video/quicktime";

        case "zip" :
          return "application/zip";

        case "tar" :
          return "application/x-tar";

        case "swf" :
          return "application/x-shockwave-flash";

        default :
          //если расширение нен найдено
          if(function_exists("mime_content_type"))
          {
            $fileSuffix = mime_content_type($filename);
          }

          return "unknown/" . trim($fileSuffix[0], ".");
      }
    }



}