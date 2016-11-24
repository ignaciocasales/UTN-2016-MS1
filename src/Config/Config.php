<?php

namespace Config;

    /**
     * define('ROOT', dirname(dirname(__FILE__)) . DS); //str_replace("/", "\\", $_SERVER['CONTEXT_DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI']));
     * define('__ROOT__', dirname(dirname(__FILE__)));
     */

// Constantes Base de datos.
define("DB_NAME", "trafimdq");
define("DB_USER", "root");
define("DB_PASS", "ckl123");
define("DB_HOST", "localhost");

// Constantes front
define('ROOT', dirname(__DIR__) . "/");
define("URL_VISTA", ROOT . 'Vistas/');
define("URL_CSS", '/css/');
define("URL_ESTILO", '/estilo/');
define("URL_JS", '/js/');
define("URL_IMG", '/img/');
define("URL_BOOTSTRAP", URL_CSS . 'bootstrap.min.css');

/*
 *
 * Constantes Server
 * define('HOST_ROOT', __DIR__ . '/src/');
 * define('HOST_URL_THEME', HOST_ROOT . 'Vistas/');
 *
 *
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