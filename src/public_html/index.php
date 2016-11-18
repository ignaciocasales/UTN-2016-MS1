<?php

if (empty($_SESSION)) {
    session_start();
}

//$identifcador = session_id();
//echo "El identifcador de esta sesión es: $identifcador";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../Config/Config.php';
require_once '../Config/Autoload.php';

Config\Autoload::iniciar();

include URL_VISTA . 'header.php';

Config\Router::direccionar(new Config\Request());

include URL_VISTA . 'footer.php';