<?php


namespace App\Models;


class Publications extends MySqlModel
{
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
        $stmt = $this->connection -> query($sql);
        return $stmt -> fetchAll(\PDO::FETCH_CLASS);
    }
}