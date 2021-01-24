<?php


namespace App\Uploader;


class ImageUploader
{
    private $image;
    private $imageDir;
    private $errorList = [];

    public function __construct($image, $imageDir)
    {
        $this->image = $image;
        $this->imageDir = $imageDir;
    }

    private function getImageName()
    {
        $name = $this -> getAndIncrCount() . "." . $this -> getExt();
        return $name;
    }

    private function getExt(){
        return strtolower(pathinfo($this -> image["name"], PATHINFO_EXTENSION));
    }

    public function getFullMediaDir()
    {
        return MEDIA . $this->imageDir . "/" .  $this->getImageName();
    }

    private function getAndIncrCount()
    {
        $jsonPath = __DIR__ . "/image-count.json";
        $json = file_get_contents($jsonPath);
        $arr = json_decode($json,true);
        $count = $arr["counter"];
        $arr["counter"]++;
        $json = json_encode($arr);
        file_put_contents($jsonPath,$json);
        return $count;
    }

}