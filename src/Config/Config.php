<?php

namespace Config;

//define('ROOT', dirname(dirname(__FILE__)) . DS); //str_replace("/", "\\", $_SERVER['CONTEXT_DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI']));
//define('__ROOT__', dirname(dirname(__FILE__)));


// Constantes Base de datos
define("DB_NAME", " c0100371_gym ");
define("DB_USER", "c0100371_gym");
define("DB_PASS", "SO64nugiro");
define("DB_HOST", "localhost");

// Constantes front
//define('THEME_NAME', 'tema1');
define('ROOT', dirname(__DIR__) . "/");
define("URL_THEME", "../Vistas/");
define("URL_CSS", URL_THEME . "css");
define("URL_JS", URL_THEME . "js");

// Constantes Server
define('HOST_ROOT', __DIR__ . '/src/');
//define('HOST_URL_THEME', HOST_ROOT . 'vistas/'. THEME_NAME . '/');

/**
echo '<p>Constante DS:' . DS . '</p>';
echo '<p>Constante ROOT:' . ROOT . '</p>';
echo '<p>Constante DB_NAME:' . DB_NAME . '</p>';
echo '<p>Constante DB_USER:' . DB_USER . '</p>';
echo '<p>Constante DB_PASS:' . DB_PASS . '</p>';
echo '<p>Constante DB_HOST:' . DB_HOST . '</p>';
echo '<p>Constante URL_THEME:' . URL_THEME . '</p>';
echo '<p>Constante URL_CSS:' . URL_CSS . '</p>';
echo '<p>Constante URL_JS:' . URL_JS . '</p>';
echo '<p>Constante THEME_NAME:' . THEME_NAME . '</p>';

echo '<pre>';
print_r($_SERVER);
echo '</pre>';
*/