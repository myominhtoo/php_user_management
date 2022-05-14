<?php
    namespace Helpers;

    class HTTP{
        static $base_URL = "http://localhost:8088/php_project";

        static function redirect($path , $query = ""){
            $url = static::$base_URL . $path ;
            if($query) $url .= "?$query";

            header("location: $url");
            exit();
        }
    }
