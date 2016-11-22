<?php
/*
 * Si la variable de sesión esta vacía, entonces
 * inicio la sesión...
 */
if (empty($_SESSION)) {
    session_start();
}
/*
 * Si quiero ver el identificador de sesión, descomento:
 *
 * $identifcador = session_id();
 * echo "El identifcador de esta sesión es: $identifcador";
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../Config/Config.php';
require_once '../Config/Autoload.php';

Config\Autoload::iniciar();

include URL_VISTA . 'header.php'; //El header es estático para todas las páginas.

Config\Router::direccionar(new Config\Request());

include URL_VISTA . 'footer.php'; //El footer es estático para todas las páginas.