<?php
    namespace Helpers;

    class Auth{
        static $loginURL = "/index.php";

        static function check(){
            session_start();
            if(isset($_SESSION['user'])){
                return $_SESSION['user'];
            }else{
                HTTP::redirect(static::$loginURL);
            }
        }
    }