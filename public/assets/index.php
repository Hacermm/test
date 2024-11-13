<?php

declare(strict_types=1);
session_start();
require_once "../vendor/autoload.php";


use App\Controllers\Front\HomeController;
use App\Controllers\Front\AboutController;
use Core\Route;

$request = $_SERVER['REQUEST_URI'];



switch ($request) {
    case '/':
        $controller = new HomeController();
        $controller->index();
        break;
    case '/about':
        $controller = new AboutController();
        $controller->index();
        break;
    default:
        echo "404 Not Found";
}