<?php


namespace App\Models;

use Str;
use File;

class UploadImage
{
    public $file;
    public $fileBase64;
    public $folderName;
    public $fileFormat;
    public $fileName;
    public $directory;
    public $fileUrl;
    public $siteUrl;

    public static function save( $fileBase64, $folderName = 'pictures', $fileFormat = 'jpg'  ) {
        $model = new self();

        $model->siteUrl = config('app.url');

        $model->fileBase64 = $fileBase64;
        $model->folderName = $folderName;
        $model->fileFormat = $fileFormat;

        $model->directory = $model->getFileDirectory();
        $model->fileName = $model->createFileName();

        $model->decodeBase64Image()->saveFile();

        $model->fileUrl = $model->getFileUrl();

        return $model;
    }

    public function getData() {
        return array(
            'name' => $this->fileName,
            'format' => $this->fileFormat,
            'url' => $this->fileUrl
        );
    }

    public function getName() {
        return $this->fileName;
    }

    public function getFormat() {
        return $this->fileFormat;
    }

    public function getUrl() {
        return $this->fileUrl;
    }

    protected function decodeBase64Image() {

        $fileBase64 = $this->fileBase64;
        // $resultSearchImgData = strripos($imageInBase64Format, 'data:image/jpg;base64');

        $file = str_replace('data:image/jpg;base64,', '', $fileBase64);
        $file = str_replace(' ', '+', $file);

        $file = base64_decode($file);

        $this->file = $file;

        return $this;
    }

    protected function getFileDirectory() {
        $publicPath = public_path();
        $folderName = $this->folderName;

        $directory = "$publicPath/storage/$folderName";

        if (!file_exists($directory)) {
            mkdir($directory, 666, true);
        }

        return $directory;
    }

    protected function createFileName() {

        $fileFirstName = Str::random(10);
        $fileFormat = $this->fileFormat;

        $fileName = "$fileFirstName.$fileFormat";

        return $fileName;
    }

    protected function saveFile() {
        $directory = $this->directory;
        $fileName = $this->fileName;
        $file = $this->file;

        File::put($directory.'/'.$fileName, $file);

        return $this;
    }

    protected function getFileUrl() {
        $folderName = $this->folderName;
        $fileName = $this->fileName;
        $siteUrl = $this->siteUrl;

        $fileUrl = "$siteUrl/storage/$folderName/$fileName";

        return $fileUrl;
    }
}
