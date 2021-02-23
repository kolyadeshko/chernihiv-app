<?php


namespace App\Models;


class Publications extends MySqlModel
{
    static public $fields = [
        "id", "description", ""
    ];
    public $tablename = "publications";

    public function getPublications($sqlParams){
        $where = $this -> sqlParser -> getCondition($sqlParams);
        $limit = $this -> sqlParser -> getLimit($sqlParams);
        $sql = "SELECT
                            publications.*,
                            category.categoryname,
                            users.nickname,
                            users.isadmin
                        FROM (
                            (
                                publications LEFT JOIN category ON publications.categoryid = category.id
                            ) 
                                INNER JOIN users ON users.id = publications.userid
                            )" . $where . $limit;

        // получаем публикации
        $stmt = $this->connection -> prepare($sql);
        $stmt -> execute($sqlParams);
        $publications = $stmt -> fetchAll(\PDO::FETCH_CLASS);
        // количество
        $pubCountSql = "SELECT COUNT(*) AS count FROM publications ".$where;
        $stmt = $this -> connection -> prepare($pubCountSql);
        $stmt -> execute($sqlParams);
        $pubCount = $stmt -> fetch()['count'];

        return [
            "publications" => $publications,
            "pubCount" => $pubCount
        ];
    }
    public function getDetailPublication($id)
    {
        $sql = "SELECT
                        publications.*,
                        users.nickname,
                        category.categoryname
                        FROM (
                            (publications LEFT JOIN category ON publications.categoryid = category.id)
                            INNER JOIN users ON users.id = publications.userid
                            ) WHERE publications.id=:id AND publications.publicated
                            ";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> execute(['id' => $id]);
        return $stmt -> fetch(\PDO::FETCH_ASSOC);
    }

    public  function insertPublication($data){
        if ($data['categoryid'] === "") unset($data["categoryid"]);
        $sql = $this -> sqlParser -> getInsertExpression($this -> tablename,$data);
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> execute($data);
    }
    public function getRowCount()
    {
        $sql = "SELECT COUNT(*) as count FROM {$this -> tablename} WHERE publicated";
        return $this -> connection -> query($sql) -> fetch()['count'];

    }
}