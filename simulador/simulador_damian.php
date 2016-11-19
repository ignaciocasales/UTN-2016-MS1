<?php

namespace simulador;

//php simulador_damian.php cantidad = <<introducir cantidad>> ;
// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
date_default_timezone_set('UTC');
// VARIABLE GLOBAL DESDE CONSOLA
parse_str(implode('&', array_slice($argv, 1)), $_GET);

$cantidad = $_GET["cantidad"];

echo '....SIMULANDO....';

//////////////////////////////////////////////////////////////////////////////
require_once '../src/Config/Config.php';

foreach (glob("../src/Dao/*.php") as $filename) {
    $string = null;
    $string = strpos($filename, "IDao");
    if ($string != null) {
        require_once $filename;
    }
}

foreach (glob("../src/Dao/*.php") as $filename) {
    $string = null;
    $string = strpos($filename, "Json");
    if ($string == null) {
        require_once $filename;
    }
}

foreach (glob("../src/Modelo/*.php") as $filename) {
    require_once $filename;
}

foreach (glob("../src/Controladoras/*.php") as $filename) {
    require_once $filename;
}
/////////////////////////////////////////////////////////////////////////

use Dao\VehiculoBdDao;
use Dao\CuentaCorrienteBdDao;
use Dao\TarifaBdDao;
use Dao\SensorSemaforoBdDao;
use Dao\SensorPeajeBdDao;
use Dao\EventoMultaBdDao;
use Dao\EventoPeajeBdDao;
use Dao\MovimientoCuentaCorrienteBdDao;
use Modelo\MovimientoCuentaCorriente;
use Modelo\EventoPeaje;
use Modelo\EventoMulta;

////////////////////////////////////////////////////////////////////////

//////////FUNCIONES/////////////////////////////////////////////////

function randomDate($start_date, $end_date)
{
    // Convert to timetamps
    $min = strtotime($start_date);
    $max = strtotime($end_date);

    // Generate random number using above bounds
    $val = rand($min, $max);

    // Convert back to desired date format
    return date('Y-m-d H:i:s', $val);
}

/////////////////////////////////////////////////////////////////////
try {
    $daoVehiculos = VehiculoBdDao::getInstancia();
    $daoCuentaCorriente = CuentaCorrienteBdDao::getInstancia();
    $daoTarifa = TarifaBdDao::getInstancia();
    $daoSensorS = SensorSemaforoBdDao::getInstancia();
    $daoEventoM = EventoMultaBdDao::getInstancia();
    $daoSensorP = SensorPeajeBdDao::getInstancia();
    $daoEventoP = EventoPeajeBdDao::getInstancia();
    $daoMovimientoCuentaCorriente = MovimientoCuentaCorrienteBdDao::getInstancia();


//////////////////////////////////////////////////////////////////////

    $lista_vehiculos = $daoVehiculos->traerTodo();

    for ($i = 0; $i < $cantidad; $i++) {

        do {
            $clave = array_rand($lista_vehiculos, 1);

        } while ($clave == 0);

        $vehiculoRandom = $daoVehiculos->traerPorId($clave);

        $date = randomDate("2016-11-01 00:00:01", "2016-12-31 23:59:59");

        $eventoArray = ['peaje', 'multa'];

        $tipo_evento = $eventoArray[array_rand($eventoArray)];

        $vehiculo = $daoVehiculos->traerPorDominio($vehiculoRandom->getDominio());

        $cuentaCorriente = $daoCuentaCorriente->traerPorId($vehiculo->getId());

        $tarifa = $daoTarifa->traerPorFecha($date);

        $movimientoCuentaCorriente = null;

        if ($tipo_evento === 'multa') {

            $evento = new EventoMulta($date);

            $sensor = $daoSensorS->traerCualquiera();

            $evento->setSensorSemaforo($sensor);

            $evento->setId($daoEventoM->agregar($evento));

            $movimientoCuentaCorriente = new MovimientoCuentaCorriente($date, $tarifa->getMulta(), $cuentaCorriente);
            $movimientoCuentaCorriente->setEventoMulta($evento);

        } else if ($tipo_evento === 'peaje') {

            $evento = new EventoPeaje($date);

            $sensor = $daoSensorP->traerCualquiera();

            $evento->setSensorPeaje($sensor);

            $evento->setId($daoEventoP->agregar($evento));

            $movimientoCuentaCorriente = new MovimientoCuentaCorriente($date, $tarifa->getPeajeHorasPico(), $cuentaCorriente);
            $movimientoCuentaCorriente->setEventoPeaje($evento);

        } else {
            echo 'error';
        }
        $daoMovimientoCuentaCorriente->agregar($movimientoCuentaCorriente);
    }
}catch (\PDOException $e){
    echo 'No se pudo conectar con la Base de datos';
}catch (\Exception $e){
    echo  'Hubo un error al procesar los datos';
}