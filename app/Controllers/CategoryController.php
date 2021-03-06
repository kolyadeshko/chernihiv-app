<?php


namespace App\Controllers;


use App\Controller;

class CategoryController extends Controller
{
    public function getCategoryList(){
        $categories = $this -> models['category'] -> getCategories();
        return $this -> renderer -> render(
            $this->request,
            "categorylist",
            [
                "categories" => $categories,
            ]
        );
    }
    public function categoriesForPublicationAdd(){
        return json_encode($this -> models['category'] -> getCategories());
    }

}