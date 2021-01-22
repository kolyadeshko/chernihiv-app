<?php


namespace App\Models;


class Category extends MySqlModel
{
    public $tablename = "category";



    public function getCategories(){
        $sql =
            "
            SELECT 
                category.id,
                category.categoryname,
                category.photo, COUNT(publications.id) AS pub_count
                FROM 
                    category 
                INNER JOIN 
                    publications ON publications.categoryid = category.id 
                GROUP BY 
                publications.categoryid
                ORDER BY pub_count DESC
            ";
        $stmt = $this->connection -> query($sql);
        return $stmt -> fetchAll(\PDO::FETCH_CLASS);
    }


}