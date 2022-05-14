<?php
    include("../vendor/autoload.php");

    use Helpers\HTTP;

    session_start();

    session_destroy();

    HTTP::redirect("/index.php");