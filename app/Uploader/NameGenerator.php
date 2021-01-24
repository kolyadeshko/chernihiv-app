<?php


namespace App\Uploader;


class NameGenerator
{
    public static function generageName(){
        $jsonPath = __DIR__ . "/image-count.json";
        $json = file_get_contents($jsonPath);
        $arr = json_decode($json, true);
        $count = $arr["counter"];
        $arr["counter"]++;
        $json = json_encode($arr);
        file_put_contents($jsonPath, $json);
        return $count;
    }
}