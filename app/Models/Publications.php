<?php


namespace App\Models;


class Publications extends MySqlModel
{
    static public $fields = [
        "id", "description", ""
    ];


    public function getPublicationsByCategory($sqlParams){
        $where = $this -> sqlParser -> getCondition($sqlParams);
        $sql = "SELECT
                            publications.*,
                            category.categoryname,
                            users.username,
                            users.isadmin
                        FROM (
                            (
                                publications LEFT JOIN category ON publications.categoryid = category.id
                            ) 
                                INNER JOIN users ON users.id = publications.userid
                            )" . $where;
        echo ($sql);
        $stmt = $this->connection -> prepare($sql);
        $stmt -> execute($sqlParams);
        return $stmt -> fetchAll(\PDO::FETCH_CLASS);
    }
    public  function insertPublication($data){
        if ($data['categoryid'] === "") unset($data["categoryid"]);
        $sql = "INSERT INTO publications {$this->sqlParser->getInsertExpression($data)}";
        $this -> connection -> query($sql);

    }
}