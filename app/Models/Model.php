<?php


namespace App\Models;


interface Model
{
    public function getById($id);
    public function getAll();
}