<?php


namespace App\Uploader;


class ImageUploader
{
    private $image;
    private $imageDir;
    private $errorList = [];
    private $name;

    public function __construct($image, $imageDir)
    {
        $this -> image = $image;
        $this -> imageDir = $imageDir;
        $this -> name = NameGenerator::generageName();
    }

    private function getImageName()
    {
        $name = $this->name . "." . $this->getExt();
        return $name;
    }

    private function getExt()
    {
        return strtolower(pathinfo($this->image["name"], PATHINFO_EXTENSION));
    }

    public function getFullMediaDir()
    {
        return $this->imageDir . "/" . $this->getImageName();
    }

    private function getAndIncrCount()
    {
        $jsonPath = __DIR__ . "/image-count.json";
        $json = file_get_contents($jsonPath);
        $arr = json_decode($json, true);
        $count = $arr["counter"];
        $arr["counter"]++;
        $json = json_encode($arr);
        file_put_contents($jsonPath, $json);
        return $count;
    }

    public function validate()
    {
        $this->validateImageSize();
        $this->validateIsImage();
        $this->validateExtension();

    }

    // проверяет изображение ли загруженный файл
    private function validateIsImage()
    {
        $check = getimagesize($this->image["tmp_name"]);
        if ($check === false) {
            $this->pushError("Загруженный файл не изображение!");
        }
    }

    private function validateImageSize($maxSize = 5 * 1024 * 1024)
    {
        $size = $this->image["size"];
        if ($size > $maxSize) {
            $this->pushError("Размер загруженного изображения ($size) 
            превышает допустимый размер ($maxSize)");
        }
    }

    private function validateExtension()
    {
        $ext = $this->getExt();
        $validExt = ["gif", "jpg", "jpeg", "png"];
        if (!in_array($ext, $validExt)) {
            $extString = join(",", $validExt);
            $this->pushError("Расширение .$ext - недопустимо!
            Допустимые значения: $extString");
        }
    }

    private function pushError($string)
    {
        array_push($this->errorList,$string);
    }

    public function getErrorList()
    {
        if (empty($this->errorList)) {
            return false;
        } else {
            return $this->errorList;
        }
    }

    public function upload()
    {
        move_uploaded_file(
            $this -> image["tmp_name"],
            $this -> getFullMediaDir()
        );
    }

}