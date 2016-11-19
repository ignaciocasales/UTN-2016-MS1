<?php
//Para ejecutar por CLI: 'php simulador_nacho.php <cantidad>'

//Se puede ejecutar tanto por CLI como por HTTP
if ($_GET) {
    $cantidad = $_GET['cantidad'];
} else {
    $cantidad = $argv[1];
}

echo 'Generando ...';

//Defino constantes para almacenar las direcciones de las clases.
define("SRC_CONFIG", '../src/Config/');
define("SRC_DAO", '../src/Dao/');
define("SRC_MODELO", '../src/Modelo/');

//Incluyo todas las clases necesarias.
require(SRC_CONFIG . "Config.php");

//MODELO
require(SRC_MODELO . "CuentaCorriente.php");
require(SRC_MODELO . "EventoMulta.php");
require(SRC_MODELO . "EventoPeaje.php");
require(SRC_MODELO . "MovimientoCuentaCorriente.php");
require(SRC_MODELO . "Rol.php");
require(SRC_MODELO . "Sensor.php");
require(SRC_MODELO . "SensorPeaje.php");
require(SRC_MODELO . "SensorSemaforo.php");
require(SRC_MODELO . "Tarifa.php");
require(SRC_MODELO . "Titular.php");
require(SRC_MODELO . "Usuario.php");
require(SRC_MODELO . "Vehiculo.php");

//DAO
require(SRC_DAO . "Conexion.php");
require(SRC_DAO . "CuentaCorrienteIDao.php");
require(SRC_DAO . "CuentaCorrienteBdDao.php");
require(SRC_DAO . "EventoIDao.php");
require(SRC_DAO . "EventoMultaBdDao.php");
require(SRC_DAO . "EventoPeajeBdDao.php");
require(SRC_DAO . "MovimientoCuentaCorrienteIDao.php");
require(SRC_DAO . "MovimientoCuentaCorrienteBdDao.php");
require(SRC_DAO . "RolIDao.php");
require(SRC_DAO . "RolBdDao.php");
require(SRC_DAO . "SensorIDao.php");
require(SRC_DAO . "SensorPeajeBdDao.php");
require(SRC_DAO . "SensorSemaforoBdDao.php");
require(SRC_DAO . "TarifaIDao.php");
require(SRC_DAO . "TarifaBdDao.php");
require(SRC_DAO . "TitularIDao.php");
require(SRC_DAO . "TitularBdDao.php");
require(SRC_DAO . "UsuarioIDao.php");
require(SRC_DAO . "UsuarioBdDao.php");
require(SRC_DAO . "VehiculoIDao.php");
require(SRC_DAO . "VehiculoBdDao.php");

//Me instancio los DAO
$daoVehiculo = \Dao\VehiculoBdDao::getInstancia();
$daoCC = \Dao\CuentaCorrienteBdDao::getInstancia();
$daoTarifa = \Dao\TarifaBdDao::getInstancia();
$daoSemaforo = \Dao\SensorSemaforoBdDao::getInstancia();
$daoPeaje = \Dao\SensorPeajeBdDao::getInstancia();
$daoEventoMulta = \Dao\EventoMultaBdDao::getInstancia();
$daoEventoPeaje = \Dao\EventoPeajeBdDao::getInstancia();
$daoMovimientoCuentaCorriente = \Dao\MovimientoCuentaCorrienteBdDao::getInstancia();

//Defino los tipos de eventos que maneja el sistema.
$eventos = array('multa', 'peaje');

//Defino las fecha máxima y mínima para generar los eventos.
//Elegi esas fechas porque son las que están cargadas en la base de datos.
$min_date = '2016-11-01 00:00:00';
$max_date = '2016-12-31 23:59:59';

//Repito n veces, según se indique por parámetro pasado al script.
try {
    for ($i = 0; $i <= $cantidad - 1; $i++) {

        //Me genero una fecha aleatoria.
        $fechaAleatoria = rand_date($min_date, $max_date);

        //Me traigo todos los vehiculos y con 'array_rand()' me traigo el indice aleatorio de un objeto del arreglo.
        $vehiculos = $daoVehiculo->traerTodo();
        $vehiculoKey = array_rand($vehiculos, 1);

        //Me traigo la cuenta corriente del vehiculo seleccionado aleatoriamente en el paso anterior.
        $cuentaCorriente = $daoCC->traerPorId($vehiculos[$vehiculoKey]->getId());

        //Me traigo la tarifa correspondie a la fecha aleatoria.
        $tarifas = $daoTarifa->traerPorFecha(date('Y-m-d H:i:s', $fechaAleatoria));

        //Selecciono aleatoriamente el evento. Si va a ser multa o peaje.
        $eventoKey = array_rand($eventos, 1);

        //Si es multa, cargo el movimiento correspondiente con la tarifa correspondiente.
        //Si es peaje, cargo el movimiento correspondiente con la tarifa correspondiente ya además verifico si es hora pico u hora normal.
        if ($eventos[$eventoKey] === 'multa') {

            $evento = new \Modelo\EventoMulta(date('Y-m-d H:i:s', $fechaAleatoria));

            $sensores = $daoSemaforo->traerTodo();
            $sensorKey = array_rand($sensores, 1);

            $evento->setSensorSemaforo($sensores[$sensorKey]);

            $evento->setId($daoEventoMulta->agregar($evento));

            $movimientoCuentaCorriente = new \Modelo\MovimientoCuentaCorriente(date('Y-m-d H:i:s', $fechaAleatoria), $tarifas->getMulta(), $cuentaCorriente);
            $movimientoCuentaCorriente->setEventoMulta($evento);

        } else if ($eventos[$eventoKey] === 'peaje') {

            $evento = new \Modelo\EventoPeaje(date('Y-m-d H:i:s', $fechaAleatoria));

            $sensores = $daoPeaje->traerTodo();
            $sensorKey = array_rand($sensores, 1);

            $evento->setSensorPeaje($sensores[$sensorKey]);

            $evento->setId($daoEventoPeaje->agregar($evento));

            $horaPicoManianaDesde = strtotime('07:00:00');
            $horaPicoManianaHasta = strtotime('10:00:00');
            $horaPicoTardeDesde = strtotime('17:00:00');
            $horaPicoTardeHasta = strtotime('20:00:00');

            $hora = strtotime(date('H:i:s', $fechaAleatoria));

            if (($hora >= $horaPicoManianaDesde && $hora <= $horaPicoManianaHasta) || ($hora >= $horaPicoTardeDesde && $hora <= $horaPicoTardeHasta)) {

                $importe = $tarifas->getPeajeHorasPico();

            } else {

                $importe = $tarifas->getPeajeHorasNormal();

            }

            $movimientoCuentaCorriente = new \Modelo\MovimientoCuentaCorriente(date('Y-m-d H:i:s', $fechaAleatoria), $importe, $cuentaCorriente);
            $movimientoCuentaCorriente->setEventoPeaje($evento);

        }

        $daoMovimientoCuentaCorriente->agregar($movimientoCuentaCorriente);
    }

    echo 'Se genero' . ' ' . $cantidad . ' ' . 'evento/s';

} catch (\PDOException $e) {

    echo 'No se pudo conectar a la base de datos';

}


function rand_date($min_date, $max_date)
{
    $min_epoch = strtotime($min_date);
    $max_epoch = strtotime($max_date);

    $rand_epoch = rand($min_epoch, $max_epoch);

    return $rand_epoch;
}