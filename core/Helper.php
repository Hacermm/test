<?php

namespace Core;

class Helper
{
    public static function getViewFile($fileName){
        $filename = '../app/Views/' . $fileName . '.php';

        if(!file_exists($filename)){
            echo "File not found";
            exit;
        }

        return $filename;
    }

    public static function explodeController(string $method): array
    {
        return explode('@', $method);
    }
}