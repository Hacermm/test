<?php

namespace App\Controllers\Front;

use Core\Helper;

class AboutController
{
    public function index()
    {
        require_once Helper::getViewFile("about");
    }
}