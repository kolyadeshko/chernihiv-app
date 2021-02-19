<?php


namespace App\Models;


use App\Models\Connections\MySqlConnection;
use App\SQLparser;

class MySqlModel implements Model
{
    protected $connection ;
    public $tablename;
    protected $sqlParser;

    public function __construct(SQLparser $sqlParser)
    {
        $this -> connection = MySqlConnection::getConnection();
        $this -> sqlParser = $sqlParser;
    }

    public function getById($id)
    {
        $stmt = $this->connection->prepare(
            "SELECT*FROM $this->tablename WHERE id=$id"

        );
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS)[0];

    }



    public function getAll()
    {
        $stmt = $this->connection->prepare(
            "SELECT*FROM $this->tablename"
        );
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS);
    }

    public function getRowsCount(){
        return $this -> connection -> query(
            "SELECT COUNT(*) as count FROM {$this->tablename}"
        ) -> fetch()['count'];
    }

}