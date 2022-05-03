<?php

namespace app\models;

use Exception;
use yii\base\Model;
use yii\web\UploadedFile;
use tpmanc\imagick\Imagick;
use Yii;

class UploadFile extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $files;
    /**
     * @var String
     */
    public $filename;
    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10],
        ];
    }

    public function uploadAll()
    {
        if ($this->validate()) {
            foreach ($this->files as $file) {
                $this->filename = $this->generateFileName($file);
                $filepath = $this->getFullPathForSave();
                if (!$file->saveAs($filepath, false)) {
                    $this->addError('UploadFile', 'Ошибка загрузки файлов!');
                }
            }
            return true;
        } else {
            return false;
        }
    }
    public function uploadOne($file, $compression = null)
    {
        if ($this->validate()) {
            $this->filename = $this->generateFileName($file);
            $filepath = $this->getFullPathForSave();


            if (!$file->saveAs($filepath, false)) {
                $this->addError('UploadFile', 'Ошибка загрузки файлов!');
            }

            if ($compression !== null) {
                $this->compressionImage($compression, $file, $filepath);
            }
            return true;
        } else {
            return false;
        }
    }
    private function compressionImage($compression, $file, $filepath)
    {
        if ($file->extension == "png") {
            return true;
        }
        $imagePath = Yii::getAlias('@app') . "/public_html/$filepath";
        $img = new \Imagick($imagePath);

        $imagick = new \Imagick();

        $imagick->setCompression(\Imagick::COMPRESSION_JPEG);
        $imagick->setCompressionQuality($compression);
        $imagick->newPseudoImage(
            $img->getImageWidth(),
            $img->getImageHeight(),
            'canvas:white'
        );
        $imagick->compositeImage(
            $img,
            \Imagick::COMPOSITE_ATOP,
            0,
            0
        );
        $imagick->setImageFormat($file->extension);
        $imagick->writeImage($imagePath);
    }
    public function getFullPathForSave()
    {
        $dir = Yii::getAlias('@app') . '/public_html/uploads';
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0700)) {
                throw new Exception('Не удалось создать директорию');
            }
        }
        return 'uploads/' . $this->filename;
    }
    public function generateFileName($file)
    {
        return $file->name . '-' . Yii::$app->getSecurity()->generateRandomString(15) . '.' . $file->extension;
    }
}
