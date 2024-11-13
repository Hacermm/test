<?php
namespace App\Controllers\Front;
use Core\Helper;

class HomeController
{
    public function index(): void
    {
        $datas = ['name' => 'Fazil', 'email' => 'fazil@gmail.com'];
        require_once Helper::getViewFile("home");
    }
}