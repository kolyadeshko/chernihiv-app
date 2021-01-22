<?php


namespace App\Models\Connections;

use \PDO;

class MySqlConnection
{
    private static $connection;

    public static function getConnection(){
        if(!self::$connection){
            self::$connection = new \PDO(
                "mysql:host=127.0.0.1:3306;dbname=chernihivphp",
                "kolya_php",
                "ve228hr2"
            );
        }
        return self::$connection;
    }

}