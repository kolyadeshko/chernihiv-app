<?php


namespace App;

use App\Models\Category;
use App\Models\Publications;
use App\Models\Users;
use App\Template\Renderer;

class Controller
{
    protected $request;
    protected $renderer;
    protected $models;
    protected $session;

    public function __construct(
        Request $request,
        Renderer $renderer,
        Publications $publications,
        Category $category,
        Users $users,
        Session $session
    )
    {
        $this->models = [
            "publications" => $publications,
            "category" => $category,
            "users" => $users
        ];
        $this->request = $request;
        $this->renderer = $renderer;
        $this -> session = $session;
    }
    // принимает на ссылку на массив с sql параметрами
    // и работает с ключем page , превращая его в выражение LIMIT
    public function getPagination(&$sqlParams, $itemCount)
    {
        if (preg_match('/^\d+$/',$sqlParams['page'])) {
            $sqlParams['limit'] = [
                ($sqlParams['page'] - 1) * $itemCount,
                $itemCount
            ];
        }else {
            $sqlParams['limit'] = "$itemCount";
        }
        unset($sqlParams['page']);
    }
    protected function redirect($url){
        return header("Location:$url");
    }

}
