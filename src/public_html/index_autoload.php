<?php


    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

require_once ('../config/Autoload.php');

$a = new Autoload();
$a->iniciar();

echo 'aaa';

$t = new \Modelo\Titular('tacconi','38831230','damian','472-3393','damigoku');

echo 'aaa';

?>