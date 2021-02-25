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
                        publications.id,
                        publications.description,
                        publications.created,
                        publications.views,
                        publications.categoryid,
                        publications.photo,
                        publications.userid,
                        publications.users_likes,
                        JSON_LENGTH(users_likes) AS likes,
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
        $data['users_likes'] = '[]';
        $sql = $this -> sqlParser -> getInsertExpression($this -> tablename,$data);
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> execute($data);
    }
    public function getRowCount()
    {
        $sql = "SELECT COUNT(*) as count FROM {$this -> tablename} WHERE publicated";
        return $this -> connection -> query($sql) -> fetch()['count'];

    }


    public function addPublicationView($id){
        $sql = "UPDATE `publications` SET `views` =`views`+1 WHERE `publications`.`id` = :id";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> execute([ "id" => $id ]);
    }

    public function changeLike($userId,$publicationId){
        // получаем запись
        $sql = "SELECT users_likes FROM publications WHERE id=:id";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> execute(['id' => $publicationId]);
        // массив лайков под записью
        $likes = json_decode($stmt ->fetch(\PDO::FETCH_ASSOC)['users_likes']);
        // переменная которая фиксирует был ли
        // удален элемент с массива лайкнувших
        $delete = 0;
        foreach ($likes as $key => $value){
            if ($value === $userId){
                unset($likes[$key]);
                $delete = 1;
                break;
            }
        }
        // если с массива не было удалено элемент,
        // то добавляем его
        if (!$delete) $likes[] = $userId;
        $likes = json_encode($likes);
        $sql = "UPDATE `publications` SET users_likes=:users_likes WHERE id=:id";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> execute(['id' => $publicationId,'users_likes'=>$likes]);
    }
}