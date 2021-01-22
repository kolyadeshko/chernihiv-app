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

    public function __construct(
        Request $request,
        Renderer $renderer,
        Publications $publications,
        Category $category,
        Users $users
    )
    {
        $this->models = [
            "publications" => $publications,
            "category" => $category,
            "users" => $users
        ];
        $this->request = $request;
        $this->renderer = $renderer;
    }
}
