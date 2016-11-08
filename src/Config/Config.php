<?php

namespace Config;

/**
 * define('ROOT', dirname(dirname(__FILE__)) . DS); //str_replace("/", "\\", $_SERVER['CONTEXT_DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI']));
 * define('__ROOT__', dirname(dirname(__FILE__)));
 */

// Constantes Base de datos.
//La base de datos esta cargada en el servidor de la UTN con mis datos, si quieren usarla está para eso!!!
//Sino, pueden cambiarla.
define("DB_NAME", "casalesi");
define("DB_USER", "casalesi");
define("DB_PASS", "ckl123");
define("DB_HOST", "git.mdp.utn.edu.ar");

// Constantes front
define('ROOT', dirname(__DIR__) . "/");
define("URL_VISTA", ROOT . 'Vistas/');
define("URL_FEROZO", '//rk000697.ferozo.com/dyd');
define("URL_PUBLIC", '//localhost/');//esta linea hay que cambiar para que funcione.
define("URL_CSS", URL_PUBLIC . 'css/');
define("URL_ESTILO", URL_PUBLIC . 'estilo/');
define("URL_JS", URL_PUBLIC . 'js/');
define("URL_IMG", URL_PUBLIC . 'img/');
define("URL_BOOTSTRAP", URL_CSS . 'bootstrap.min.css');

// Constantes Server
define('HOST_ROOT', __DIR__ . '/src/');
define('HOST_URL_THEME', HOST_ROOT . 'Vistas/');

/**
 * echo '<p>Constante ROOT:' . ROOT . '</p>';
 * echo '<p>Constante DB_NAME:' . DB_NAME . '</p>';
 * echo '<p>Constante DB_USER:' . DB_USER . '</p>';
 * echo '<p>Constante DB_PASS:' . DB_PASS . '</p>';
 * echo '<p>Constante DB_HOST:' . DB_HOST . '</p>';
 * echo '<p>Constante URL_VISTA:' . URL_VISTA . '</p>';
 * echo '<p>Constante URL_CSS:' . URL_CSS . '</p>';
 * echo '<p>Constante URL_JS:' . URL_JS . '</p>';
 * echo '<p>Constante HOST_ROOT:' . HOST_ROOT . '</p>';
 *
 * echo '<pre>';
 * print_r($_SERVER);
 * echo '</pre>';
 */