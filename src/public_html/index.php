<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../Config/Autoload.php";
require "../Config/Config.php";

Config\Autoload::iniciar();

include URL_THEME . 'header.php';

Config\Router::direccionar(new Config\Request());

include URL_THEME . 'footer.php';