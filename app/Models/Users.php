<?php


namespace App\Models;


class Users extends MySqlModel
{
    public $tablename = "users";

    public function getByField($field, $value){
        $sql = "SELECT * FROM users WHERE {$field} = :{$field}";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> execute([ $field => $value]);
        return $stmt -> fetchAll(\PDO::FETCH_ASSOC);
    }
    public function registerUser($userData){
        $insertExpression =
            $this -> sqlParser -> getInsertExpression(
                $this -> tablename,
                $userData);
        $stmt = $this -> connection -> prepare($insertExpression);
        $stmt -> execute($userData);
    }
    public function getUserByNickname($nickname){
        $sql = "SELECT * FROM `users` WHERE `nickname`=:nickname";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> execute(['nickname' => $nickname]);
        return $stmt -> fetch(\PDO::FETCH_ASSOC);
    }
}