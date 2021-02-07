<?php


namespace App\Models;


class Users extends MySqlModel
{
    public function getByField($field, $value){
        $sql = "SELECT * FROM users WHERE {$field} = :{$field}";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> execute([ $field => $value]);
        return $stmt -> fetchAll(\PDO::FETCH_ASSOC);
    }
}